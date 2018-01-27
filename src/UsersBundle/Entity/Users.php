<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UsersBundle\Entity\UsersSession;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Users
 *
 * @ORM\Table(name="user_compte")
 * @ORM\Entity(repositoryClass="UsersBundle\Repository\UsersRepository")
 */
class Users extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    // is_logged_in
    public static function is_logged_in (Request $request)
    {
        $return = $request->cookies->get('login');
        return $return ? true : false;
    }

    // if loggedin
    // public static function getLogin() 
    // {
    //     return $request->cookies->get('login');
    // }

    /** getting the cookie login with different of user session */
    public static function getCookieLogin () 
    {
        $cookie = array_key_exists('login', $_COOKIE) ? array($_COOKIE['login']):array();
        if(!count($cookie)) return $cookie;
        $cookie = base64_decode($cookie[0]);
        $cookie = explode('$$', $cookie);
        return $cookie;
    }

    // getting current user
    public static function getCurrentUsers ($key=null) 
    {
        // decrypte 1
        $cookie = self::getCookieLogin();
        if (!$cookie) return;

        // decrypte 2
        $cookie = base64_decode($cookie[0]);
        $cookie = explode('$_', $cookie);
        if(!$cookie) return;
        $cookie = explode('__', $cookie[0]);
        if(!$cookie) return;
        $users = unserialize($cookie[1]);
        
        if($key&&array_key_exists($key, $users))
            return $users[$key]?$users[$key]:0;
        return $users['id'];
    }

    // to loging out
    public static function logout (Request $request, $doctrine) 
    {   
        // getting cookie
        $cookie = self::getCookieLogin();
        if(!count($cookie)) return;// on return rien si il ya pas de cookie

        // remove cookie
        $response = new Response();
        $response->headers->clearCookie('login');
        $response->send();

        // session
        UsersSession::clearSession($doctrine, $cookie[1]);
    }

    // request
    public function login (Request $request, $doctrine, $self, $secret) 
    {
        // getting user and langage
        $em = $doctrine->getManager();
        
        // getting lang of users
        // $lang = $em->getRepository('AppBundle:Common\Langage')->findOneBy(['id' => $self->getIdLangage() ? $self->getIdLangage() : 1]);

        // param
        $param = $em->getRepository('ProjectBundle:Back\Param')->findBy(['label' => 'cookie_life']);
        $param2 = $em->getRepository('ProjectBundle:Back\Param')->findBy(['label' => 'cookie_lifetime']);

        // users
        if( $self ): 
            $login = [
                'id' => $self->getId(),
                'user' => $self->getUsername(), 
                'password' => base64_encode($self->getPassword()),
                // 'lang' => $lang->getAbr()
                ];

            // the secret token
            $date = new \DateTime(sprintf('now %s', date('e')));
            $secret = base64_encode($secret . '__' . serialize($login) . '$_' . $date->format('Y-m-d h:i:s'));
            
            // session for user
            $session = new UsersSession();
            $session->setSessionToken( $secret );
            $session->setIpClient( $request->getClientIp() );
            $session->setDate( $date );
            // save to bdd
            $em = $doctrine->getManager();
            $em->persist($session);
            $em->flush();

            $session_id = $session->getId();
            $secret = base64_encode($secret . '$$' . $session_id);

            // now response
            $response = new Response();
            $response->headers->setCookie(new Cookie('login', $secret, strtotime( sprintf('now + %s day', count($param) ? $param[0]->getValue() : '1')), '/' ));
            $response->headers->setCookie(new Cookie('cookie_lifetime', (count($param2) ? $param2[0]->getValue() : 3600), strtotime('now + 0 day'), '/'));
            $response->send();

            // for locale, deprecated
            // $request->getSession()->set('_locale', $login['lang']);

            // redirect to homepage
            return $request->get('referer');
        else:
            // to login
            return 'users_index';
        endif;
    }

    /**
    * Remove Session
    *
    * @param Request $request, Doctrine $doctrine
    *
    * @return Array result
    */
    public static function remSession (Request $request, $doctrine) {
        $qb = $doctrine->getManager()->createQueryBuilder()
            ->delete('UsersBundle:UsersSession', 'us')
            ->where('us.ipClient = :ip_client AND us.date < :date')
            ->setParameter('ip_client', $request->getClientIp())
            ->setParameter('date', date('Y-m-d h:i:s'))
            ->getQuery();
        return $qb->getResult();
    }

    /**
    * Check md5
    *
    * @return Boolean
    */
    public static function is_md5 ($md5) 
    {
        return preg_match('/^[a-f0-9]{32}$/', $md5);
    }
}
