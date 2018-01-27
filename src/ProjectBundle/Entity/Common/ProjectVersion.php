<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectVersion
 *
 * @ORM\Table(name="projet_versions")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectVersionRepository")
 */
class ProjectVersion
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
     * @ORM\Column(name="idProjet", type="integer", length=11)
     */
    private $idProjet;

    /**
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumn(name="idProjet", referencedColumnName="id")
     */
    private $project;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=80)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=10)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="idCreateur", type="integer", length=11)
     */
    private $idCreateur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="date")
     */
    private $dateCreation;

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
     * @ORM\Column(name="statut", type="integer", length=11)
     */
    private $statut;

    /**
     * @var int
     *
     * @ORM\Column(name="idLeader", type="integer", length=11)
     */
    private $idLeader;

    /**
     * @var int
     *
     * @ORM\Column(name="idArchitecte", type="integer", length=11)
     */
    private $idArchitecte;

    /**
     * @var int
     *
     * @ORM\Column(name="idSupport_fonctionnel", type="integer", length=11)
     */
    private $idSupportFonctionnel;

    /**
     * @var int
     *
     * @ORM\Column(name="idSupport_technique", type="integer", length=11)
     */
    private $idSupportTechnique;

    /**
     * @var int
     *
     * @ORM\Column(name="idReferent_direction", type="integer", length=11)
     */
    private $idReferentDirection;

    /**
     * @var int
     *
     * @ORM\Column(name="idReferent_utilisateurs", type="integer", length=11)
     */
    private $idReferentUtilisateurs;

    /**
     * @var int
     *
     * @ORM\Column(name="idSupport_tests", type="integer", length=11)
     */
    private $idSupportTests;

    /**
     * @var int
     *
     * @ORM\Column(name="idSupport_deploiement", type="integer", length=11)
     */
    private $idSupportDeploiement;

    /**
     * @var int
     *
     * @ORM\Column(name="joursHommes_prevus", type="integer", length=11)
     */
    private $joursHommesPrevus;

    /**
     * @var int
     *
     * @ORM\Column(name="joursHommes_reels", type="integer", length=11)
     */
    private $joursHommesReels;

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
     * Set idProjet
     *
     * @param integer $idProjet
     *
     * @return ProjectVersion
     */
    public function setIdProjet($idProjet)
    {
        $this->idProjet = $idProjet;

        return $this;
    }

    /**
     * Get idProjet
     *
     * @return int
     */
    public function getIdProjet()
    {
        return $this->idProjet;
    }

    /**
     * Set project
     *
     * @return Project
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return ProjectVersion
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return ProjectVersion
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return ProjectVersion
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ProjectVersion
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set idCreateur
     *
     * @param integer $idCreateur
     *
     * @return ProjectVersion
     */
    public function setIdCreateur($idCreateur)
    {
        $this->idCreateur = $idCreateur;

        return $this;
    }

    /**
     * Get idCreateur
     *
     * @return int
     */
    public function getIdCreateur()
    {
        return $this->idCreateur;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return ProjectVersion
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return ProjectVersion
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
     * @return ProjectVersion
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
     * Set statut
     *
     * @param integer $statut
     *
     * @return ProjectVersion
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return int
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set idLeader
     *
     * @param integer $idLeader
     *
     * @return ProjectVersion
     */
    public function setIdLeader($idLeader)
    {
        $this->idLeader = $idLeader;

        return $this;
    }

    /**
     * Get idLeader
     *
     * @return int
     */
    public function getIdLeader()
    {
        return $this->idLeader;
    }

    /**
     * Set idArchitecte
     *
     * @param integer $idArchitecte
     *
     * @return ProjectVersion
     */
    public function setIdArchitecte($idArchitecte)
    {
        $this->idArchitecte = $idArchitecte;

        return $this;
    }

    /**
     * Get idArchitecte
     *
     * @return int
     */
    public function getIdArchitecte()
    {
        return $this->idArchitecte;
    }

    /**
     * Set idSupportFonctionnel
     *
     * @param integer $idSupportFonctionnel
     *
     * @return ProjectVersion
     */
    public function setIdSupportFonctionnel($idSupportFonctionnel)
    {
        $this->idSupportFonctionnel = $idSupportFonctionnel;

        return $this;
    }

    /**
     * Get idSupportFonctionnel
     *
     * @return int
     */
    public function getIdSupportFonctionnel()
    {
        return $this->idSupportFonctionnel;
    }

    /**
     * Set idSupportTechnique
     *
     * @param integer $idSupportTechnique
     *
     * @return ProjectVersion
     */
    public function setIdSupportTechnique($idSupportTechnique)
    {
        $this->idSupportTechnique = $idSupportTechnique;

        return $this;
    }

    /**
     * Get idSupportTechnique
     *
     * @return int
     */
    public function getIdSupportTechnique()
    {
        return $this->idSupportTechnique;
    }

    /**
     * Set idReferentDirection
     *
     * @param integer $idReferentDirection
     *
     * @return ProjectVersion
     */
    public function setIdReferentDirection($idReferentDirection)
    {
        $this->idReferentDirection = $idReferentDirection;

        return $this;
    }

    /**
     * Get idReferentDirection
     *
     * @return int
     */
    public function getIdReferentDirection()
    {
        return $this->idReferentDirection;
    }

    /**
     * Set idReferentUtilisateurs
     *
     * @param integer $idReferentUtilisateurs
     *
     * @return ProjectVersion
     */
    public function setIdReferentUtilisateurs($idReferentUtilisateurs)
    {
        $this->idReferentUtilisateurs = $idReferentUtilisateurs;

        return $this;
    }

    /**
     * Get idReferentUtilisateurs
     *
     * @return int
     */
    public function getIdReferentUtilisateurs()
    {
        return $this->idReferentUtilisateurs;
    }

    /**
     * Set idSupportTests
     *
     * @param integer $idSupportTests
     *
     * @return ProjectVersion
     */
    public function setIdSupportTests($idSupportTests)
    {
        $this->idSupportTests = $idSupportTests;

        return $this;
    }

    /**
     * Get idSupportTests
     *
     * @return int
     */
    public function getIdSupportTests()
    {
        return $this->idSupportTests;
    }

    /**
     * Set idSupportDeploiement
     *
     * @param integer $idSupportDeploiement
     *
     * @return ProjectVersion
     */
    public function setIdSupportDeploiement($idSupportDeploiement)
    {
        $this->idSupportDeploiement = $idSupportDeploiement;

        return $this;
    }

    /**
     * Get idSupportDeploiement
     *
     * @return int
     */
    public function getIdSupportDeploiement()
    {
        return $this->idSupportDeploiement;
    }

    /**
     * Set joursHommesPrevus
     *
     * @param integer $joursHommesPrevus
     *
     * @return ProjectVersion
     */
    public function setJoursHommesPrevus($joursHommesPrevus)
    {
        $this->joursHommesPrevus = $joursHommesPrevus;

        return $this;
    }

    /**
     * Get joursHommesPrevus
     *
     * @return int
     */
    public function getJoursHommesPrevus()
    {
        return $this->joursHommesPrevus;
    }

    /**
     * Set joursHommesReels
     *
     * @param integer $joursHommesReels
     *
     * @return ProjectVersion
     */
    public function setJoursHommesReels($joursHommesReels)
    {
        $this->joursHommesReels = $joursHommesReels;

        return $this;
    }

    /**
     * Get joursHommesReels
     *
     * @return int
     */
    public function getJoursHommesReels()
    {
        return $this->joursHommesReels;
    }
}

