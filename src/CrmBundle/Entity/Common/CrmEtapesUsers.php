<?php

namespace CrmBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmEtapesUsers
 *
 * @ORM\Table(name="crm_etapes_users")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\Common\CrmEtapesUsersRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class CrmEtapesUsers
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
     * @ORM\Column(name="idCRM", type="integer", length=11)
     */
    private $idCRM;

    /**
     * @var int
     *
     * @ORM\Column(name="idEtape", type="integer", length=11)
     */
    private $idEtape;

    /**
     * @var string
     *
     * @ORM\Column(name="mission", type="text")
     */
    private $mission = "";

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebut", type="datetime")
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="datetime")
     */
    private $datefin;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer", length=11)
     */
    private $idUser;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="\UsersBundle\Entity\UserClient")
     * @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="idRole", type="integer", length=11)
     */
    private $idRole = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="flagActeur", type="integer", length=11)
     */
    private $flagActeur = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="flagInvite", type="integer", length=11)
     */
    private $flagInvite = 0;


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
     * Set idCRM
     *
     * @param integer $idCRM
     *
     * @return CrmEtapesUsers
     */
    public function setIdCRM($idCRM)
    {
        $this->idCRM = $idCRM;

        return $this;
    }

    /**
     * Get idCRM
     *
     * @return int
     */
    public function getIdCRM()
    {
        return $this->idCRM;
    }

    /**
     * Set idEtape
     *
     * @param integer $idEtape
     *
     * @return CrmEtapesUsers
     */
    public function setIdEtape($idEtape)
    {
        $this->idEtape = $idEtape;

        return $this;
    }

    /**
     * Get idEtape
     *
     * @return int
     */
    public function getIdEtape()
    {
        return $this->idEtape;
    }

    /**
     * Set mission
     *
     * @param string $mission
     *
     * @return CrmEtapesUsers
     */
    public function setMission($mission)
    {
        $this->mission = $mission;

        return $this;
    }

    /**
     * Get mission
     *
     * @return string
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return CrmEtapesUsers
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     *
     * @return CrmEtapesUsers
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return CrmEtapesUsers
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idRole
     *
     * @param integer $idRole
     *
     * @return CrmEtapesUsers
     */
    public function setIdRole($idRole)
    {
        $this->idRole = $idRole;

        return $this;
    }

    /**
     * Get idRole
     *
     * @return int
     */
    public function getIdRole()
    {
        return $this->idRole;
    }

    /**
     * Set flagActeur
     *
     * @param integer $flagActeur
     *
     * @return CrmEtapesUsers
     */
    public function setFlagActeur($flagActeur)
    {
        $this->flagActeur = $flagActeur ? $flagActeur : $this->flagActeur;

        return $this;
    }

    /**
     * Get flagActeur
     *
     * @return int
     */
    public function getFlagActeur()
    {
        return $this->flagActeur;
    }

    /**
     * Set flagInvite
     *
     * @param integer $flagInvite
     *
     * @return CrmEtapesUsers
     */
    public function setFlagInvite($flagInvite)
    {
        $this->flagInvite = $flagInvite ? $flagInvite : $this->flagInvite;

        return $this;
    }

    /**
     * Get flagInvite
     *
     * @return int
     */
    public function getFlagInvite()
    {
        return $this->flagInvite;
    }

    /**
     * Set user
     *
     * @param integer $user
     *
     * @return CrmEtapesUsers
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }
}

