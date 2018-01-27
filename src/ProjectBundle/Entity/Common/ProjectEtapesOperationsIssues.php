<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectEtapesOperationsIssues
 *
 * @ORM\Table(name="projet_etapes_operations_issues")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectEtapesOperationsIssuesRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class ProjectEtapesOperationsIssues
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
    private $idProjectVersion;

    /**
     * @var int
     */
    private $projet;

    /**
     * @var int
     *
     * @ORM\Column(name="idEtape", type="integer", length=11)
     */
    private $idEtape;

    /**
     * @var object
     */
    private $etape;

    /**
     * @var int
     *
     * @ORM\Column(name="idOperation", type="integer", length=11)
     */
    private $idOperation;

    /**
     * @var object
     */
    private $operation;

    /**
     * @var int
     *
     * @ORM\Column(name="idAgenda", type="integer", length=11)
     */
    private $idAgenda;

    /**
     * @var int
     *
     * @ORM\Column(name="idTypeIssue", type="integer", length=11)
     */
    private $idTypeIssue;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=80)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionProbleme", type="text")
     */
    private $descriptionProbleme;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionCorrection", type="text")
     */
    private $descriptionCorrection;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datedebut", type="date")
     */
    private $datedebut;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datefin", type="date")
     */
    private $datefin;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datedebutcorrection", type="date")
     */
    private $datedebutcorrection;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datefincorrection", type="date")
     */
    private $datefincorrection;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datedebutvalidation", type="date")
     */
    private $datedebutvalidation;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datefinvalidation", type="date")
     */
    private $datefinvalidation;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser4creation", type="integer", length=11)
     */
    private $idUser4creation;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser4correction", type="integer", length=11)
     */
    private $idUser4correction;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser4validation", type="integer", length=11)
     */
    private $idUser4validation;

    /**
     * @var int
     *
     * @ORM\Column(name="idPriorite", type="integer", length=11)
     */
    private $idPriorite;

    /**
     * @var int
     *
     * @ORM\Column(name="idStatut", type="integer", length=11)
     */
    private $idStatut;

    /**
     * @var int
     *
     * @ORM\Column(name="idResolution", type="integer", length=11)
     */
    private $idResolution;

    /**
     * @var int
     *
     * @ORM\Column(name="version", type="integer", length=11)
     */
    private $version;


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
     * Set idProjectVersion
     *
     * @param integer $idProjectVersion
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setIdProjectVersion($idProjectVersion)
    {
        $this->idProjectVersion = $idProjectVersion;

        return $this;
    }

    /**
     * Get idProjectVersion
     *
     * @return int
     */
    public function getIdProjectVersion()
    {
        return $this->idProjectVersion;
    }

    /**
     * Set projet
     *
     * @param integer $projet
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setProjet($projet)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get idProjectVersion
     *
     * @return int
     */
    public function getProjet()
    {
        return $this->projet;
    }

    /**
     * Set idEtape
     *
     * @param integer $idEtape
     *
     * @return ProjectEtapesOperationsIssues
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
     * Set etape
     *
     * @param integer $etape
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setEtape($etape)
    {
        $this->etape = $etape;

        return $this;
    }

    /**
     * Get etape
     *
     * @return int
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * Set idOperation
     *
     * @param integer $idOperation
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setIdOperation($idOperation)
    {
        $this->idOperation = $idOperation;

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
     * @return ProjectEtapesOperationsIssues
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;

        return $this;
    }

    /**
     * Get operation
     *
     * @return int
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * Set idAgenda
     *
     * @param integer $idAgenda
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setIdAgenda($idAgenda)
    {
        $this->idAgenda = $idAgenda;

        return $this;
    }

    /**
     * Get idAgenda
     *
     * @return int
     */
    public function getIdAgenda()
    {
        return $this->idAgenda;
    }

    /**
     * Set idTypeIssue
     *
     * @param integer $idTypeIssue
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setIdTypeIssue($idTypeIssue)
    {
        $this->idTypeIssue = $idTypeIssue;

        return $this;
    }

    /**
     * Get idTypeIssue
     *
     * @return int
     */
    public function getIdTypeIssue()
    {
        return $this->idTypeIssue;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set descriptionProbleme
     *
     * @param string $descriptionProbleme
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setDescriptionProbleme($descriptionProbleme)
    {
        $this->descriptionProbleme = $descriptionProbleme;

        return $this;
    }

    /**
     * Get descriptionProbleme
     *
     * @return string
     */
    public function getDescriptionProbleme()
    {
        return $this->descriptionProbleme;
    }

    /**
     * Set descriptionCorrection
     *
     * @param string $descriptionCorrection
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setDescriptionCorrection($descriptionCorrection)
    {
        $this->descriptionCorrection = $descriptionCorrection;

        return $this;
    }

    /**
     * Get descriptionCorrection
     *
     * @return string
     */
    public function getDescriptionCorrection()
    {
        return $this->descriptionCorrection;
    }

    /**
     * Set datedebut
     *
     * @param \Date $datedebut
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \Date
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \Date $datefin
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \Date
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set datedebutcorrection
     *
     * @param \Date $datedebutcorrection
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setDatedebutcorrection($datedebutcorrection)
    {
        $this->datedebutcorrection = $datedebutcorrection;

        return $this;
    }

    /**
     * Get datedebutcorrection
     *
     * @return \Date
     */
    public function getDatedebutcorrection()
    {
        return $this->datedebutcorrection;
    }

    /**
     * Set datefincorrection
     *
     * @param \Date $datefincorrection
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setDatefincorrection($datefincorrection)
    {
        $this->datefincorrection = $datefincorrection;

        return $this;
    }

    /**
     * Get datefincorrection
     *
     * @return \Date
     */
    public function getDatefincorrection()
    {
        return $this->datefincorrection;
    }

    /**
     * Set datedebutvalidation
     *
     * @param \Date $datedebutvalidation
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setDatedebutvalidation($datedebutvalidation)
    {
        $this->datedebutvalidation = $datedebutvalidation;

        return $this;
    }

    /**
     * Get datedebutvalidation
     *
     * @return \Date
     */
    public function getDatedebutvalidation()
    {
        return $this->datedebutvalidation;
    }

    /**
     * Set datefinvalidation
     *
     * @param \Date $datefinvalidation
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setDatefinvalidation($datefinvalidation)
    {
        $this->datefinvalidation = $datefinvalidation;

        return $this;
    }

    /**
     * Get datefinvalidation
     *
     * @return \Date
     */
    public function getDatefinvalidation()
    {
        return $this->datefinvalidation;
    }

    /**
     * Set idUser4creation
     *
     * @param integer $idUser4creation
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setIdUser4creation($idUser4creation)
    {
        $this->idUser4creation = $idUser4creation;

        return $this;
    }

    /**
     * Get idUser4creation
     *
     * @return int
     */
    public function getIdUser4creation()
    {
        return $this->idUser4creation;
    }

    /**
     * Set idUser4correction
     *
     * @param integer $idUser4correction
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setIdUser4correction($idUser4correction)
    {
        $this->idUser4correction = $idUser4correction;

        return $this;
    }

    /**
     * Get idUser4correction
     *
     * @return int
     */
    public function getIdUser4correction()
    {
        return $this->idUser4correction;
    }

    /**
     * Set idUser4validation
     *
     * @param integer $idUser4validation
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setIdUser4validation($idUser4validation)
    {
        $this->idUser4validation = $idUser4validation;

        return $this;
    }

    /**
     * Get idUser4validation
     *
     * @return int
     */
    public function getIdUser4validation()
    {
        return $this->idUser4validation;
    }

    /**
     * Set idPriorite
     *
     * @param integer $idPriorite
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setIdPriorite($idPriorite)
    {
        $this->idPriorite = $idPriorite;

        return $this;
    }

    /**
     * Get idPriorite
     *
     * @return int
     */
    public function getIdPriorite()
    {
        return $this->idPriorite;
    }

    /**
     * Set idStatut
     *
     * @param integer $idStatut
     *
     * @return ProjectEtapesOperationsIssues
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
     * Set idResolution
     *
     * @param integer $idResolution
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setIdResolution($idResolution)
    {
        $this->idResolution = $idResolution;

        return $this;
    }

    /**
     * Get idResolution
     *
     * @return int
     */
    public function getIdResolution()
    {
        return $this->idResolution;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return ProjectEtapesOperationsIssues
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }
}

