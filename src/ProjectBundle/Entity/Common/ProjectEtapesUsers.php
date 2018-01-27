<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectEtapesOperationsUsers
 *
 * @ORM\Table(name="projet_etapes_users")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectEtapesOperationsUsersRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class ProjectEtapesUsers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", length=11)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idProjetversion", type="integer", length=11)
     */
    private $idProjetversion;

    /**
     * @var int
     *
     * @ORM\Column(name="idEtape", type="integer", length=11)
     */
    private $idEtape = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="mission", type="text")
     */
    private $mission = '';

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
    private $idUser = 0;

    /**
     * @var object
     * @ORM\ManyToOne(targetEntity="\UsersBundle\Entity\UserClient", fetch="EAGER")
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
     * @param integer $idProjetversion
     *
     * @return ProjectEtapesOperationsUsers
     */
    public function setIdProjetversion($idProjetversion)
    {
        $this->idProjetversion = $idProjetversion;

        return $this;
    }

    /**
     * Get idProjetversion
     *
     * @return int
     */
    public function getIdProjetversion()
    {
        return $this->idProjetversion;
    }

    /**
     * Set idEtape
     *
     * @param integer $idEtape
     *
     * @return ProjectEtapesOperationsUsers
     */
    public function setIdEtape($idEtape)
    {
        $this->idEtape = $idEtape ? $idEtape : $this->idEtape;

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
     * @return ProjectEtapesOperationsUsers
     */
    public function setMission($mission)
    {
        $this->mission = $mission ? $mission : $this->mission;

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
     * @return ProjectEtapesOperationsUsers
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
     * @return ProjectEtapesOperationsUsers
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
     * @return ProjectEtapesOperationsUsers
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser ? $idUser : $this->idUser;

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
     * Set user
     *
     * @param object $user
     *
     * @return ProjectEtapesOperationsUsers
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return object
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set idRole
     *
     * @param integer $idRole
     *
     * @return ProjectEtapesOperationsUsers
     */
    public function setIdRole($idRole)
    {
        $this->idRole = $idRole ? $idRole : $this->idRole;

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
     * @return ProjectEtapesOperationsUsers
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
     * @return ProjectEtapesOperationsUsers
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
}

