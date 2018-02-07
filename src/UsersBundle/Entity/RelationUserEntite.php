<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RelationUserEntite
 *
 * @ORM\Table(name="r_user_entite_j")
 * @ORM\Entity(repositoryClass="UsersBundle\Repository\RelationUserEntiteRepository")
 */
class RelationUserEntite
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
     * @ORM\Column(name="IdEntiteJ", type="integer")
     */
    private $idEntiteJ;

    /**
    * @var object
    *
    * @ORM\ManyToOne(targetEntity="ClientBundle\Entity\Client", fetch="EAGER")
    * @ORM\JoinColumn(name="IdEntiteJ", referencedColumnName="IDEntite", nullable=true)
    */
    private $entite;

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
     * @ORM\Column(name="Id_r_bu_entitej", type="integer")
     */
    private $iDUserEntite = 0;

    /**
    * @var object
    *
    * @ORM\ManyToOne(targetEntity="UsersBundle\Entity\RelationBusinessEntite", fetch="EAGER")
    * @ORM\JoinColumn(name="Id_r_bu_entitej", referencedColumnName="id", nullable=true)
    */
    private $relations;

    /**
     * @var int
     *
     * @ORM\Column(name="IDRelation_Fonctionnelle", type="integer")
     */
    private $iDRelationFonctionnelle;

    /**
    * @var object
    */
    private $relations_fonction;

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
     * Set idEntiteJ
     *
     * @param integer $idEntiteJ
     *
     * @return RelationUserEntite
     */
    public function setIdEntiteJ($idEntiteJ)
    {
        $this->idEntiteJ = $idEntiteJ;

        return $this;
    }

    /**
     * Get idEntiteJ
     *
     * @return integer
     */
    public function getIdEntiteJ()
    {
        return $this->idEntiteJ;
    }

    /**
     * Set iDUser
     *
     * @param integer $iDUser
     *
     * @return RelationUserEntite
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
     * Set iDUserEntite
     *
     * @param integer $iDUserEntite
     *
     * @return RelationUserEntite
     */
    public function setIDUserEntite($iDUserEntite)
    {
        $this->iDUserEntite = $iDUserEntite ? $iDUserEntite : $this->iDUserEntite;

        return $this;
    }

    /**
     * Get iDUserEntite
     *
     * @return integer
     */
    public function getIDUserEntite()
    {
        return $this->iDUserEntite;
    }

    /**
     * Set entitej
     *
     * @param \ProjectBundle\Entity\Back\EntityJ $entitej
     *
     * @return RelationUserEntite
     */
    public function setEntitej(\ProjectBundle\Entity\Back\EntityJ $entitej = null)
    {
        $this->entitej = $entitej;

        return $this;
    }

    /**
     * Get entitej
     *
     * @return \ProjectBundle\Entity\Back\EntityJ
     */
    public function getEntitej()
    {
        return $this->entitej;
    }

    /**
     * Set user
     *
     * @param \UsersBundle\Entity\UserClient $user
     *
     * @return RelationUserEntite
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
     * Set relations
     *
     * @param \UsersBundle\Entity\Back\RelationBusinessEntite $relations
     *
     * @return RelationUserEntite
     */
    public function setRelations(\UsersBundle\Entity\RelationBusinessEntite $relations = null)
    {
        $this->relations = $relations;

        return $this;
    }

    /**
     * Get relations
     *
     * @return \UsersBundle\Entity\Back\RelationBusinessEntite
     */
    public function getRelations()
    {
        return $this->relations;
    }

    /**
     * Set entite
     *
     * @param \ClientBundle\Entity\Client $entite
     *
     * @return RelationUserEntite
     */
    public function setEntite(\ClientBundle\Entity\Client $entite = null)
    {
        $this->entite = $entite;

        return $this;
    }

    /**
     * Get entite
     *
     * @return \ClientBundle\Entity\Client
     */
    public function getEntite()
    {
        return $this->entite;
    }

    /**
     * Set iDRelationFonctionnelle
     *
     * @param integer $iDRelationFonctionnelle
     *
     * @return RelationUserEntite
     */
    public function setIDRelationFonctionnelle($iDRelationFonctionnelle)
    {
        $this->iDRelationFonctionnelle = $iDRelationFonctionnelle;

        return $this;
    }

    /**
     * Get iDRelationFonctionnelle
     *
     * @return integer
     */
    public function getIDRelationFonctionnelle()
    {
        return $this->iDRelationFonctionnelle;
    }

    /**
     * Set relationsFonction
     *
     * @param \UsersBundle\Entity\Back\UsersParamRelationsFonctions $relationsFonction
     *
     * @return RelationUserEntite
     */
    public function setRelations_fonction(\UsersBundle\Entity\Back\UsersParamRelationsFonctions $relationsFonction = null)
    {
        $this->relations_fonction = $relationsFonction;

        return $this;
    }

    /**
     * Get relationsFonction
     *
     * @return \UsersBundle\Entity\Back\UsersParamRelationsFonctions
     */
    public function getRelations_fonction()
    {
        return $this->relations_fonction;
    }

    /**
     * Set service
     *
     * @param \UsersBundle\Entity\Back\UsersParamRelationsFonctions $relationsFonction
     *
     * @return RelationUserEntite
     */
    public function setService($service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return 
     */
    public function getService()
    {
        return $this->service;
    }
}
