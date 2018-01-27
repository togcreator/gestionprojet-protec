<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectGroupePilotageUsers
 *
 * @ORM\Table(name="projet_groupe_pilotage_users")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectGroupePilotageUsersRepository")
 */
class ProjectGroupePilotageUsers
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
     * @ORM\Column(name="idProjetVersion", type="integer")
     */
    private $idProjetVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="mission", type="text")
     */
    private $mission;

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
     * @ORM\Column(name="idUser", type="integer")
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="idRole", type="integer")
     */
    private $idRole;


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
     * Set idProjetVersion
     *
     * @param integer $idProjetVersion
     *
     * @return ProjectGroupePilotageUsers
     */
    public function setIdProjetVersion($idProjetVersion)
    {
        $this->idProjetVersion = $idProjetVersion;

        return $this;
    }

    /**
     * Get idProjetVersion
     *
     * @return int
     */
    public function getIdProjetVersion()
    {
        return $this->idProjetVersion;
    }

    /**
     * Set mission
     *
     * @param string $mission
     *
     * @return ProjectGroupePilotageUsers
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
     * @return ProjectGroupePilotageUsers
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
     * @return ProjectGroupePilotageUsers
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
     * @return ProjectGroupePilotageUsers
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
     * @return ProjectGroupePilotageUsers
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
}

