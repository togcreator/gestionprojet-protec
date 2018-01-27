<?php

namespace AppBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersSession
 *
 * @ORM\Table(name="users_session")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Common\UsersSessionRepository")
 */
class UsersSession
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="session_token", type="text")
     */
    private $sessionToken;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_client", type="string", length=255)
     */
    private $ipClient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


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
     * Set sessionToken
     *
     * @param string $sessionToken
     *
     * @return UsersSession
     */
    public function setSessionToken($sessionToken)
    {
        $this->sessionToken = $sessionToken;

        return $this;
    }

    /**
     * Get sessionToken
     *
     * @return string
     */
    public function getSessionToken()
    {
        return $this->sessionToken;
    }

    /**
     * Set ipClient
     *
     * @param string $ipClient
     *
     * @return UsersSession
     */
    public function setIpClient($ipClient)
    {
        $this->ipClient = $ipClient;

        return $this;
    }

    /**
     * Get ipClient
     *
     * @return string
     */
    public function getIpClient()
    {
        return $this->ipClient;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return UsersSession
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /** clearSession */
    public static function clearSession ($doctrine, $cookie) 
    {
        // flush database
        $doctrine->getManager()
            ->createQueryBuilder()
            ->delete('AppBundle:Common\UsersSession', 'u')
            ->where('u.id = :id')
            ->setParameter('id', $cookie)
            ->getQuery()
            ->execute();
    }

    /** entity manage **/
    public static function getSession () 
    {
        
    }
}

