<?php

namespace MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailTrash
 *
 * @ORM\Table(name="mail_trash")
 * @ORM\Entity(repositoryClass="MailBundle\Repository\MailTrashRepository")
 */
class MailTrash
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
     *
     * @ORM\ManyToOne(targetEntity="MailBundle\Entity\MailPeople", inversedBy="mailTrash")
     * @ORM\JoinColumn(name="idMailPeople", referencedColumnName="id", nullable=true)
     */
    private $mailPeople;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date4Trash", type="datetime")
     */
    private $date4Trash;


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
     * Set date4Trash
     *
     * @param \DateTime $date4Trash
     *
     * @return MailTrash
     */
    public function setDate4Trash($date4Trash)
    {
        $this->date4Trash = $date4Trash;

        return $this;
    }

    /**
     * Get date4Trash
     *
     * @return \DateTime
     */
    public function getDate4Trash()
    {
        return $this->date4Trash;
    }

    /**
     * Set mailPeople
     *
     * @param \MailBundle\Entity\MailPeople $mailPeople
     *
     * @return MailTrash
     */
    public function setMailPeople(\MailBundle\Entity\MailPeople $mailPeople = null)
    {
        $this->mailPeople = $mailPeople;

        return $this;
    }

    /**
     * Get mailPeople
     *
     * @return \MailBundle\Entity\MailPeople
     */
    public function getMailPeople()
    {
        return $this->mailPeople;
    }
}
