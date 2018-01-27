<?php

namespace AppBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Common\UsersSession;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Common\UsersRepository")
 */
class Users
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_langage", type="integer")
     */
    private $idLangage;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string")
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="text", nullable=true)
     */
    private $adress;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string")
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string")
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string")
     */
    private $lastname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime")
     */
    private $dateCreated;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idLangage
     *
     * @param int $idLangage
     *
     * @return Users
     */
    public function setIdLangage($idLangage)
    {
        $this->idLangage = $idLangage;

        return $this;
    }

    /**
     * Get idLangage
     *
     * @return int
     */
    public function getIdLangage()
    {
        return $this->idLangage;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return Users
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Users
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Users
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Users
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Users
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Users
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    // is_logged_in
    public static function is_logged_in (Request $request)
    {
        // $cookie = new Cookie('login');
        // $login = $cookie->getValue();
        // return $login?true:false;

        $return = $request->cookies->get('login');
        return $return?true:false;
    }

    // if loggedin
    public static function getLogin() 
    {
        return $request->cookies->get('login');
    }

    /** getting the cookie login with different of user session */
    public static function getCookieLogin () 
    {
        $cookie = array_key_exists('login', $_COOKIE) ? array($_COOKIE['login']):array();
        if(!count($cookie)) return $cookie;
        $cookie = base64_decode($cookie[0]);
        $cookie = explode('$$', $cookie);
        return $cookie;
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
        $users = $em->getRepository('AppBundle:Common\Users')
            ->createQueryBuilder('u')
            ->innerJoin('AppBundle:Common\Langage',
                'l',
                Join::WITH,
                'l.id = u.idLangage')
            ->where('u.username = :username AND u.password = :password')
            ->setParameter('username', $request->get('username'))
            ->setParameter('password', $request->get('password'))
            ->getQuery();
        $users = $users->getResult();

        if( !$users ) // to login
            return 'users_index';

        // getting lang of users
        $lang = $em->getRepository('AppBundle:Common\Langage')->findBy(['id' => $users[0]->getIdLangage()]);

        // users
        if( $users ): 
            $login = [
                'id' => $users[0]->getId(),
                'user' => $users[0]->getUsername(), 
                'password' => base64_encode($users[0]->getPassword()),
                'lang' => $lang[0]->getAbr()
                ];

            // the secret token
            $date = new \DateTime();
            $secret = base64_encode($secret . '__' . serialize($login) . '$_' . $date->format('Y-m-d h:i:s'));
            
            // session for user
            $session = new UsersSession();
            $session->setSessionToken( $secret );
            $session->setIpClient( $this->get_client_ip() );
            $session->setDate( $date );

            // save to bdd
            $entityManager = $doctrine->getManager();
            $entityManager->persist($session);
            $entityManager->flush();

            $session_id = $session->getId();
            $secret = base64_encode($secret . '$$' . $session_id);

            // now response
            $response = new Response();
            $response->headers->setCookie(new Cookie('login', $secret));
            $response->send();

            // for locale, deprecated
            $request->getSession()->set('_locale', $login['lang']);

            // rediret to homepage
            return $request->get('referer');
        else:
            // to login
            return 'users_index';
        endif;
    }

    private function get_client_ip() {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}

