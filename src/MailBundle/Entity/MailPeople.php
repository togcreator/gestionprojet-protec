<?php

namespace MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailPeople
 *
 * @ORM\Table(name="mail_people", indexes={@ORM\Index(name="ByFROM", columns={"idUserFrom", "idUserTo", "id"}),
 *                                         @ORM\Index(name="ByTO", columns={"idUserTo", "idUserFrom", "id"}),
 *                                         @ORM\Index(name="ByLU", columns={"lu", "dateLecture", "id"}),
 *                                         @ORM\Index(name="ByOrigine", columns={"idOriginemail", "id"})})
 * @ORM\Entity(repositoryClass="MailBundle\Repository\MailPeopleRepository")
 */
class MailPeople
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
     * @ORM\ManyToOne(targetEntity="MailBundle\Entity\Mail", inversedBy="mailPeople")
     * @ORM\JoinColumn(name="idMail", referencedColumnName="id", nullable=true)
     */
    private $mail;

    /**
     * @ORM\OneToMany(targetEntity="MailBundle\Entity\MailTrash", cascade={"remove"}, mappedBy="mailPeople")
     */
    private $mailTrash;

    /**
     * @var int
     *
     * @ORM\Column(name="idOriginemail", type="integer", options={"default": 0})
     */
    private $idOriginemail;

    /**
     * @var int
     *
     * @ORM\Column(name="way", type="integer", options={"default": 0})
     */
    private $way;

    /**
     *
     * @ORM\ManyToOne(targetEntity="UsersBundle\Entity\UserClient", inversedBy="mailPeopleFrom")
     * @ORM\JoinColumn(name="idUserFrom", referencedColumnName="id")
     */
    private $userFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="from1", type="string", length=255, options={"default": ""})
     */
    private $from1;

    /**
     *
     * @ORM\ManyToOne(targetEntity="UsersBundle\Entity\UserClient", inversedBy="mailPeopleTo")
     * @ORM\JoinColumn(name="idUserTo", referencedColumnName="id")
     */
    private $userTo;

    /**
     * @var string
     *
     * @ORM\Column(name="to1", type="string", length=255, options={"default": ""})
     */
    private $to1;

    /**
     * @var int
     *
     * @ORM\Column(name="flagCC", type="smallint", options={"default": 0})
     */
    private $flagCC;

    /**
     * @var int
     *
     * @ORM\Column(name="flagCCI", type="smallint", options={"default": 0})
     */
    private $flagCCI;

    /**
     * @var int
     *
     * @ORM\Column(name="lu", type="integer", options={"default": 0})
     */
    private $lu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLecture", type="datetime")
     */
    private $dateLecture;

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
     * Set idOriginemail
     *
     * @param integer $idOriginemail
     *
     * @return MailPeople
     */
    public function setIdOriginemail($idOriginemail)
    {
        $this->idOriginemail = $idOriginemail;

        return $this;
    }

    /**
     * Get idOriginemail
     *
     * @return int
     */
    public function getIdOriginemail()
    {
        return $this->idOriginemail;
    }

    /**
     * Set way
     *
     * @param integer $way
     *
     * @return MailPeople
     */
    public function setWay($way)
    {
        $this->way = $way;

        return $this;
    }

    /**
     * Get way
     *
     * @return int
     */
    public function getWay()
    {
        return $this->way;
    }

    /**
     * Set from1
     *
     * @param string $from1
     *
     * @return MailPeople
     */
    public function setFrom1($from1)
    {
        $this->from1 = $from1;

        return $this;
    }

    /**
     * Get from1
     *
     * @return string
     */
    public function getFrom1()
    {
        return $this->from1;
    }

    /**
     * Set to1
     *
     * @param string $to1
     *
     * @return MailPeople
     */
    public function setTo1($to1)
    {
        $this->to1 = $to1;

        return $this;
    }

    /**
     * Get to1
     *
     * @return string
     */
    public function getTo1()
    {
        return $this->to1;
    }

    /**
     * Set flagCC
     *
     * @param integer $flagCC
     *
     * @return MailPeople
     */
    public function setFlagCC($flagCC)
    {
        $this->flagCC = $flagCC;

        return $this;
    }

    /**
     * Get flagCC
     *
     * @return int
     */
    public function getFlagCC()
    {
        return $this->flagCC;
    }

    /**
     * Set flagCCI
     *
     * @param integer $flagCCI
     *
     * @return MailPeople
     */
    public function setFlagCCI($flagCCI)
    {
        $this->flagCCI = $flagCCI;

        return $this;
    }

    /**
     * Get flagCCI
     *
     * @return int
     */
    public function getFlagCCI()
    {
        return $this->flagCCI;
    }

    /**
     * Set lu
     *
     * @param integer $lu
     *
     * @return MailPeople
     */
    public function setLu($lu)
    {
        $this->lu = $lu;

        return $this;
    }

    /**
     * Get lu
     *
     * @return int
     */
    public function getLu()
    {
        return $this->lu;
    }

    /**
     * Set dateLecture
     *
     * @param \DateTime $dateLecture
     *
     * @return MailPeople
     */
    public function setDateLecture($dateLecture)
    {
        $this->dateLecture = $dateLecture;

        return $this;
    }

    /**
     * Get dateLecture
     *
     * @return \DateTime
     */
    public function getDateLecture()
    {
        return $this->dateLecture;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return MailPeople
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
     * Set mail
     *
     * @param \MailBundle\Entity\Mail $mail
     *
     * @return MailPeople
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

    /**
     * Set userFrom
     *
     * @param \UsersBundle\Entity\UserClient $userFrom
     *
     * @return MailPeople
     */
    public function setUserFrom(\UsersBundle\Entity\UserClient $userFrom = null)
    {
        $this->userFrom = $userFrom;

        return $this;
    }

    /**
     * Get userFrom
     *
     * @return \UsersBundle\Entity\Users
     */
    public function getUserFrom()
    {
        return $this->userFrom;
    }

    /**
     * Set userTo
     *
     * @param \UsersBundle\Entity\UserClient $userTo
     *
     * @return MailPeople
     */
    public function setUserTo(\UsersBundle\Entity\UserClient $userTo)
    {
        $this->userTo = $userTo;

        return $this;
    }

    /**
     * Get userTo
     *
     * @return \UsersBundle\Entity\Users
     */
    public function getUserTo()
    {
        return $this->userTo;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return MailPeople
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function __toString()
    {
        return $this->getId().'';
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mailTrash = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add mailTrash
     *
     * @param \MailBundle\Entity\MailTrash $mailTrash
     *
     * @return MailPeople
     */
    public function addMailTrash(\MailBundle\Entity\MailTrash $mailTrash)
    {
        $this->mailTrash[] = $mailTrash;

        return $this;
    }

    /**
     * Remove mailTrash
     *
     * @param \MailBundle\Entity\MailTrash $mailTrash
     */
    public function removeMailTrash(\MailBundle\Entity\MailTrash $mailTrash)
    {
        $this->mailTrash->removeElement($mailTrash);
    }

    /**
     * Get mailTrash
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMailTrash()
    {
        return $this->mailTrash;
    }
}
