<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RelationBusinessEntite
 *
 * @ORM\Table(name="r_bu_user")
 * @ORM\Entity(repositoryClass="UsersBundle\Repository\RelationBusinessUserRepository")
 */
class RelationBusinessUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDR_BU_User", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="IDUser", type="integer")
     */
    private $iDUser;

    /**
    * @var object
    *
    * @ORM\ManyToOne(targetEntity="UsersBundle\Entity\UserClient", fetch="EAGER")
    * @ORM\JoinColumn(name="IDUser", referencedColumnName="id", nullable=true)
    */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="IDBusinessUnit", type="integer")
     */
    private $iDBusinessUnit;

    /**
    * @var object
    *
    * @ORM\ManyToOne(targetEntity="UsersBundle\Entity\BusinessUnit", fetch="EAGER")
    * @ORM\JoinColumn(name="IDBusinessUnit", referencedColumnName="IDBusinessUnit", nullable=true)
    */
    private $businessunit;

    /**
     * @var int
     *
     * @ORM\Column(name="IDRelation_Fonctionnelle", type="integer")
     */
    private $iDRelation_Fonctionnelle;

    /**
    * @var object
    *
    */
    private $relationsFonctionnelles;

    /**
    * @var object
    */
    private $service;

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
     * Set iDUser
     *
     * @param integer $iDUser
     *
     * @return RelationBusinessUser
     */
    public function setIDUser($iDUser)
    {
        $this->iDUser = $iDUser;

        return $this;
    }

    /**
     * Get iDUser
     *
     * @return integer
     */
    public function getIDUser()
    {
        return $this->iDUser;
    }

    /**
     * Set iDBusinessUnit
     *
     * @param integer $iDBusinessUnit
     *
     * @return RelationBusinessUser
     */
    public function setIDBusinessUnit($iDBusinessUnit)
    {
        $this->iDBusinessUnit = $iDBusinessUnit;

        return $this;
    }

    /**
     * Get iDBusinessUnit
     *
     * @return integer
     */
    public function getIDBusinessUnit()
    {
        return $this->iDBusinessUnit;
    }

    /**
     * Set businessunit
     *
     * @param integer $businessunit
     *
     * @return RelationBusinessUser
     */
    public function setBusinessunit($businessunit)
    {
        $this->businessunit = $businessunit;

        return $this;
    }

    /**
     * Get businessunit
     *
     * @return integer
     */
    public function getBusinessunit()
    {
        return $this->businessunit;
    }

    /**
     * Set iDRelationFonctionnelle
     *
     * @param integer $iDRelationFonctionnelle
     *
     * @return RelationBusinessUser
     */
    public function setIDRelationFonctionnelle($iDRelationFonctionnelle)
    {
        $this->iDRelation_Fonctionnelle = $iDRelationFonctionnelle;

        return $this;
    }

    /**
     * Get iDRelationFonctionnelle
     *
     * @return integer
     */
    public function getIDRelationFonctionnelle()
    {
        return $this->iDRelation_Fonctionnelle;
    }

    /**
     * Set user
     *
     * @param \UsersBundle\Entity\UserClient $user
     *
     * @return RelationBusinessUser
     */
    public function setUser(\UsersBundle\Entity\UserClient $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UsersBundle\Entity\UserClient
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set relationsFonctionnelles
     *
     * @param \UsersBundle\Entity\Back\UsersParamRelationsFonctions $relationsFonctionnelles
     *
     * @return RelationBusinessUser
     */
    public function setRelationsFonctionnelles($relationsFonctionnelles = null)
    {
        $this->relationsFonctionnelles = $relationsFonctionnelles;

        return $this;
    }

    /**
     * Get relationsFonctionnelles
     *
     * @return \UsersBundle\Entity\Back\UsersParamRelationsFonctions
     */
    public function getRelationsFonctionnelles()
    {
        return $this->relationsFonctionnelles;
    }

    /**
     * Set service
     *
     * @return RelationBusinessUser
     */
    public function setService($service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \UsersBundle\Entity\Back\UsersParamRelationsFonctions
     */
    public function getService()
    {
        return $this->service;
    }
}
