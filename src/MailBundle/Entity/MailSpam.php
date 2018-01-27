<?php

namespace MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailSpam
 *
 * @ORM\Table(name="mail_spam")
 * @ORM\Entity(repositoryClass="MailBundle\Repository\MailSpamRepository")
 */
class MailSpam
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
     * @ORM\OneToOne(targetEntity="MailBundle\Entity\Mail", inversedBy="spam")
     * @ORM\JoinColumn(name="idMail", referencedColumnName="id")
     */
    private $mail;

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
     * Set mail
     *
     * @param \MailBundle\Entity\Mail $mail
     *
     * @return MailSpam
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
