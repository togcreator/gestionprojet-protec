<?php

namespace ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientFilter
 *
 * @ORM\Table(name="client_filter")
 * @ORM\Entity(repositoryClass="ClientBundle\Repository\ClientFilterRepository")
 */
class ClientFilter
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
     * @ORM\Column(name="idEntiteJ", type="integer")
     */
    private $idEntiteJ;

    /**
     * @var int
     *
     * @ORM\Column(name="CP", type="integer")
     */
    private $cP = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idStatut", type="integer")
     */
    private $idStatut;

    /**
     * @var int
     *
     * @ORM\Column(name="idOwner", type="integer")
     */
    private $idOwner;

    /**
     * @var int
     *
     * @ORM\Column(name="idWatcher", type="integer")
     */
    private $idWatcher;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer")
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="flagprive", type="integer")
     */
    private $flagprive;

    /**
     * @var string
     *
     * @ORM\Column(name="tri", type="string", length=50)
     */
    private $tri = '';

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
     * Set idEntiteJ
     *
     * @param integer $idEntiteJ
     *
     * @return ClientFilter
     */
    public function setIdEntiteJ($idEntiteJ)
    {
        $this->idEntiteJ = $idEntiteJ;

        return $this;
    }

    /**
     * Get idEntiteJ
     *
     * @return int
     */
    public function getIdEntiteJ()
    {
        return $this->idEntiteJ;
    }

    /**
     * Set cP
     *
     * @param integer $cP
     *
     * @return ClientFilter
     */
    public function setCP($cP)
    {
        $this->cP = $cP ? $cP : $this->cP;

        return $this;
    }

    /**
     * Get cP
     *
     * @return int
     */
    public function getCP()
    {
        return $this->cP;
    }

    /**
     * Set idStatut
     *
     * @param integer $idStatut
     *
     * @return ClientFilter
     */
    public function setIdStatut($idStatut)
    {
        $this->idStatut = $idStatut;

        return $this;
    }

    /**
     * Get idStatut
     *
     * @return int
     */
    public function getIdStatut()
    {
        return $this->idStatut;
    }

    /**
     * Set idOwner
     *
     * @param integer $idOwner
     *
     * @return ClientFilter
     */
    public function setIdOwner($idOwner)
    {
        $this->idOwner = $idOwner;

        return $this;
    }

    /**
     * Get idOwner
     *
     * @return int
     */
    public function getIdOwner()
    {
        return $this->idOwner;
    }

    /**
     * Set idWatcher
     *
     * @param integer $idWatcher
     *
     * @return ClientFilter
     */
    public function setIdWatcher($idWatcher)
    {
        $this->idWatcher = $idWatcher;

        return $this;
    }

    /**
     * Get idWatcher
     *
     * @return int
     */
    public function getIdWatcher()
    {
        return $this->idWatcher;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return ClientFilter
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
     * Set flagprive
     *
     * @param integer $flagprive
     *
     * @return ClientFilter
     */
    public function setFlagprive($flagprive)
    {
        $this->flagprive = $flagprive;

        return $this;
    }

    /**
     * Get flagprive
     *
     * @return int
     */
    public function getFlagprive()
    {
        return $this->flagprive;
    }

    /**
     * Set tri
     *
     * @param string $tri
     *
     * @return ClientFilter
     */
    public function setTri($tri)
    {
        $this->tri = $tri ? $tri: $this->tri;

        return $this;
    }

    /**
     * Get tri
     *
     * @return string
     */
    public function getTri()
    {
        return $this->tri;
    }

    /**
     * Set idBUsinessUnit
     *
     * @param integer $idBUsinessUnit
     *
     * @return ClientFilter
     */
    public function setIdBUsinessUnit($idBUsinessUnit)
    {
        $this->idBUsinessUnit = $idBUsinessUnit;

        return $this;
    }

    /**
     * Get idBUsinessUnit
     *
     * @return int
     */
    public function getIdBUsinessUnit()
    {
        return $this->idBUsinessUnit;
    }

    /**
     * Set idRelationProfessionnelles
     *
     * @param integer $idRelationProfessionnelles
     *
     * @return ClientFilter
     */
    public function setIdRelationProfessionnelles($idRelationProfessionnelles)
    {
        $this->idRelationProfessionnelles = $idRelationProfessionnelles;

        return $this;
    }

    /**
     * Get idRelationProfessionnelles
     *
     * @return int
     */
    public function getIdRelationProfessionnelles()
    {
        return $this->idRelationProfessionnelles;
    }
}

