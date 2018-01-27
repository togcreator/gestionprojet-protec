<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectVersionUser
 *
 * @ORM\Table(name="projet_versions_users")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectVersionUserRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class ProjectVersionUser
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
     * @ORM\Column(name="idProjetVersion", type="integer", length=11)
     */
    private $idProjetVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="mission", type="text")
     */
    private $mission = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebut", type="date")
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="date")
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
     * @ORM\Column(name="idRelation", type="string", length=11)
     */
    private $idRelation = "";

    /**
     * @var int
     *
     * @ORM\Column(name="idRole", type="integer", length=11)
     */
    private $idRole = 0;

    /**
     * @var object
     */
    private $role;

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
     * @return ProjectVersionUser
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
     * @return ProjectVersionUser
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
     * @return ProjectVersionUser
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
     * @param string $datefin
     *
     * @return ProjectVersionUser
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return string
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
     * @return ProjectVersionUser
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
     * @return ProjectVersionUser
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
     * Set user
     *
     * @param integer $user
     *
     * @return ProjectVersionUser
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

    /**
     * Set role
     *
     * @param integer $role
     *
     * @return ProjectVersionUser
     */
    public function setRole($role)
    {
        $this->role = $role ? $role : $this->role;

        return $this;
    }

    /**
     * Get role
     *
     * @return int
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set role
     *
     * @param integer $idRelation
     *
     * @return ProjectVersionUser
     */
    public function setIdRelation($idRelation)
    {
        $this->idRelation = $idRelation;

        return $this;
    }

    /**
     * Get role
     *
     * @return int
     */
    public function getIdRelation()
    {
        return $this->idRelation;
    }
}

