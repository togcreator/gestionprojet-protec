<?php

namespace MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailMessage
 *
 * @ORM\Table(name="mail_message")
 * @ORM\Entity(repositoryClass="MailBundle\Repository\MailMessageRepository")
 */
class MailMessage
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
     * @var int
     *
     * @ORM\Column(name="user", type="integer")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="MailBundle\Entity\Mail", inversedBy="mailMessage")
     * @ORM\JoinColumn(name="idMail", referencedColumnName="id")
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var int
     *
     * @ORM\Column(name="version", type="smallint", options={"default": 0})
     */
    private $version;


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
     * Set texte
     *
     * @param string $texte
     *
     * @return MailMessage
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return MailMessage
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set user
     *
     * @param integer $user
     *
     * @return MailMessage
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set mail
     *
     * @param \MailBundle\Entity\Mail $mail
     *
     * @return MailMessage
     */
    public function setMail(\MailBundle\Entity\Mail $mail = null)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return \MailBundle\Entity\Mail
     */
    public function getMail()
    {
        return $this->mail;
    }
}
