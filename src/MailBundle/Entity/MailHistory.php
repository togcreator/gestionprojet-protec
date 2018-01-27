<?php

namespace MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailHistory
 *
 * @ORM\Table(name="mail_history")
 * @ORM\Entity(repositoryClass="MailBundle\Repository\MailHistoryRepository")
 */
class MailHistory
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
     * @ORM\Column(name="idMail", type="integer")
     */
    private $idMail;

    /**
     * @var int
     *
     * @ORM\Column(name="idUserFrom", type="integer")
     */
    private $idUserFrom;

    /**
     * @var int
     *
     * @ORM\Column(name="idUserTo", type="integer")
     */
    private $idUserTo;

    /**
     * @var bool
     *
     * @ORM\Column(name="flagCC", type="boolean")
     */
    private $flagCC;

    /**
     * @var bool
     *
     * @ORM\Column(name="flagCCI", type="boolean")
     */
    private $flagCCI;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date4History", type="datetime")
     */
    private $date4History;


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
     * Set idMail
     *
     * @param integer $idMail
     *
     * @return MailHistory
     */
    public function setIdMail($idMail)
    {
        $this->idMail = $idMail;

        return $this;
    }

    /**
     * Get idMail
     *
     * @return int
     */
    public function getIdMail()
    {
        return $this->idMail;
    }

    /**
     * Set idUserFrom
     *
     * @param integer $idUserFrom
     *
     * @return MailHistory
     */
    public function setIdUserFrom($idUserFrom)
    {
        $this->idUserFrom = $idUserFrom;

        return $this;
    }

    /**
     * Get idUserFrom
     *
     * @return int
     */
    public function getIdUserFrom()
    {
        return $this->idUserFrom;
    }

    /**
     * Set idUserTo
     *
     * @param integer $idUserTo
     *
     * @return MailHistory
     */
    public function setIdUserTo($idUserTo)
    {
        $this->idUserTo = $idUserTo;

        return $this;
    }

    /**
     * Get idUserTo
     *
     * @return int
     */
    public function getIdUserTo()
    {
        return $this->idUserTo;
    }

    /**
     * Set flagCC
     *
     * @param boolean $flagCC
     *
     * @return MailHistory
     */
    public function setFlagCC($flagCC)
    {
        $this->flagCC = $flagCC;

        return $this;
    }

    /**
     * Get flagCC
     *
     * @return bool
     */
    public function getFlagCC()
    {
        return $this->flagCC;
    }

    /**
     * Set flagCCI
     *
     * @param boolean $flagCCI
     *
     * @return MailHistory
     */
    public function setFlagCCI($flagCCI)
    {
        $this->flagCCI = $flagCCI;

        return $this;
    }

    /**
     * Get flagCCI
     *
     * @return bool
     */
    public function getFlagCCI()
    {
        return $this->flagCCI;
    }

    /**
     * Set date4History
     *
     * @param \DateTime $date4History
     *
     * @return MailHistory
     */
    public function setDate4History($date4History)
    {
        $this->date4History = $date4History;

        return $this;
    }

    /**
     * Get date4History
     *
     * @return \DateTime
     */
    public function getDate4History()
    {
        return $this->date4History;
    }
}

