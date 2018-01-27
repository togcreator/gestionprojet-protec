<?php

namespace CrmBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmOperationsUsers
 *
 * @ORM\Table(name="crm_operations_users")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\Common\CrmOperationsUsersRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class CrmOperationsUsers
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
     * @ORM\Column(name="idCRM", type="integer", length=11)
     */
    private $idCRM;

    /**
     * @var int
     */
    private $crm;

    /**
     * @var int
     *
     * @ORM\Column(name="idRelation", type="string")
     */
    private $idRelation = "";

    /**
     * @var int
     *
     * @ORM\Column(name="idOperation", type="integer", length=11)
     */
    private $idOperation = 0;

    /**
     * @var operation
     */
    private $operation;

    /**
     * @var operation
     */
    private $cycle;

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
     * @return CrmOperationsUsers
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
     * Set crm
     *
     * @param integer $crm
     *
     * @return CrmEtapesOperations
     */
    public function setCrm($crm)
    {
        $this->crm = $crm;

        return $this;
    }

    /**
     * Get crm
     *
     * @return int
     */
    public function getCrm()
    {
        return $this->crm;
    }

    /**
     * Set idRelation
     *
     * @param string $idRelation
     *
     * @return CrmOperationsUsers
     */
    public function setIdRelation($idRelation)
    {
        $this->idRelation = $idRelation ? $idRelation : $this->idRelation;

        return $this;
    }

    /**
     * Get idRelation
     *
     * @return string
     */
    public function getIdRelation()
    {
        return $this->idRelation;
    }

    /**
     * Set idOperation
     *
     * @param integer $idOperation
     *
     * @return CrmOperationsUsers
     */
    public function setIdOperation($idOperation)
    {
        $this->idOperation = $idOperation ? $idOperation : $this->idOperation;

        return $this;
    }

    /**
     * Get idOperation
     *
     * @return int
     */
    public function getIdOperation()
    {
        return $this->idOperation;
    }

    /**
     * Set operation
     *
     * @param integer $operation
     *
     * @return CrmOperationsUsers
     */
    public function setOperation($operation)
    {
        $this->operation = $operation ? $operation : $this->operation;

        return $this;
    }

    /**
     * Get idOperation
     *
     * @return int
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * Set cycle
     *
     * @param integer $cycle
     *
     * @return CrmOperationsUsers
     */
    public function setCycle($cycle)
    {
        $this->cycle = $cycle;

        return $this;
    }

    /**
     * Get idOperation
     *
     * @return int
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * Set mission
     *
     * @param string $mission
     *
     * @return CrmOperationsUsers
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
     * @return CrmOperationsUsers
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
     * @return CrmOperationsUsers
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
     * @return CrmOperationsUsers
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
     * @return CrmOperationsUsers
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
     * @return CrmOperationsUsers
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
     * @return CrmOperationsUsers
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
     * @return CrmOperationsUsers
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

