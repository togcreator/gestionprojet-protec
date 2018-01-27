<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectGroupeTravailusers
 *
 * @ORM\Table(name="common_project_groupe_travailusers")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectGroupeTravailusersRepository")
 */
class ProjectGroupeTravailusers
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
     * @var int
     *
     * @ORM\Column(name="idEtape", type="integer")
     */
    private $idEtape;

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
     * @return ProjectGroupeTravailusers
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
     * Set idEtape
     *
     * @param integer $idEtape
     *
     * @return ProjectGroupeTravailusers
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
     * @return ProjectGroupeTravailusers
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
     * @return ProjectGroupeTravailusers
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
     * @return ProjectGroupeTravailusers
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
     * @return ProjectGroupeTravailusers
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
     * @return ProjectGroupeTravailusers
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

