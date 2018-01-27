<?php

namespace CrmBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmUsers
 *
 * @ORM\Table(name="crm_users")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\Common\CrmUsersRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class CrmUsers
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
     * Set idCRM
     *
     * @param integer $idCRM
     *
     * @return CrmUsers
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
     * Set mission
     *
     * @param string $mission
     *
     * @return CrmUsers
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
     * @return CrmUsers
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
     * @return CrmUsers
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
     * @return CrmUsers
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
     * Set user
     *
     * @param integer $user
     *
     * @return CrmUser
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
     * Set idRole
     *
     * @param integer $idRole
     *
     * @return CrmUsers
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
     * Set role
     *
     * @param integer $role
     *
     * @return CrmUser
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
     * @return CrmUser
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

