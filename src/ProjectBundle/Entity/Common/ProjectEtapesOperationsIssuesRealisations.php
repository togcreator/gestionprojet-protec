<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectEtapesOperationsIssuesRealisations
 *
 * @ORM\Table(name="projet_etapes_operations_issues_realisations")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectEtapesOperationsIssuesRealisationsRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class ProjectEtapesOperationsIssuesRealisations
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
     * @ORM\Column(name="idIssue", type="integer", length=11)
     */
    private $idIssue;

    /**
     * @var object
     */
    private $issue;

    /**
     * @var string
     *
     * @ORM\Column(name="observations", type="text")
     */
    private $observations;

    /**
     * @var \Date
     *
     * @ORM\Column(name="dateaffectation", type="datetime")
     */
    private $dateafectation;

    /**
     * @var \Date
     *
     * @ORM\Column(name="daterealisation", type="datetime")
     */
    private $daterealisation;

    /**
     * @var int
     *
     * @ORM\Column(name="dureerealisation", type="integer", length=11)
     */
    private $dureerealisation;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser4affectation", type="integer", length=11)
     */
    private $idUser4affectation;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser4realisation", type="integer", length=11)
     */
    private $idUser4realisation;

    /**
     * @var int
     *
     * @ORM\Column(name="idStatut", type="integer", length=11)
     */
    private $idStatut;

    /**
     * @var int
     *
     * @ORM\Column(name="idResultat", type="integer", length=11)
     */
    private $idResultat;


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
     * @return ProjectEtapesOperationsIssuesRealisations
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
     * Set projet
     *
     * @param integer $projet
     *
     * @return ProjectEtapesJalons
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
     * @return ProjectEtapesOperationsIssuesRealisations
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
     * @return ProjectEtapesJalons
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
     * Set idIssue
     *
     * @param integer $idIssue
     *
     * @return ProjectEtapesOperationsIssuesRealisations
     */
    public function setIdIssue($idIssue)
    {
        $this->idIssue = $idIssue;

        return $this;
    }

    /**
     * Get idIssue
     *
     * @return int
     */
    public function getIdIssue()
    {
        return $this->idIssue;
    }

    /**
     * Set issue
     *
     * @param integer $issue
     *
     * @return ProjectEtapesOperationsIssuesRealisations
     */
    public function setIssue($issue)
    {
        $this->issue = $issue;

        return $this;
    }

    /**
     * Get issue
     *
     * @return int
     */
    public function getIssue()
    {
        return $this->issue;
    }

    /**
     * Set observations
     *
     * @param string $observations
     *
     * @return ProjectEtapesOperationsIssuesRealisations
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get observations
     *
     * @return string
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Set dateafectation
     *
     * @param \Date $dateafectation
     *
     * @return ProjectEtapesOperationsIssuesRealisations
     */
    public function setDateafectation($dateafectation)
    {
        $this->dateafectation = $dateafectation;

        return $this;
    }

    /**
     * Get dateafectation
     *
     * @return \Date
     */
    public function getDateafectation()
    {
        return $this->dateafectation;
    }

    /**
     * Set daterealisation
     *
     * @param \Date $daterealisation
     *
     * @return ProjectEtapesOperationsIssuesRealisations
     */
    public function setDaterealisation($daterealisation)
    {
        $this->daterealisation = $daterealisation;

        return $this;
    }

    /**
     * Get daterealisation
     *
     * @return \Date
     */
    public function getDaterealisation()
    {
        return $this->daterealisation;
    }

    /**
     * Set dureerealisation
     *
     * @param integer $dureerealisation
     *
     * @return ProjectEtapesOperationsIssuesRealisations
     */
    public function setDureerealisation($dureerealisation)
    {
        $this->dureerealisation = $dureerealisation ? $dureerealisation : 0;

        return $this;
    }

    /**
     * Get dureerealisation
     *
     * @return int
     */
    public function getDureerealisation()
    {
        return $this->dureerealisation;
    }

    /**
     * Set idUser4affectation
     *
     * @param integer $idUser4affectation
     *
     * @return ProjectEtapesOperationsIssuesRealisations
     */
    public function setIdUser4affectation($idUser4affectation)
    {
        $this->idUser4affectation = $idUser4affectation;

        return $this;
    }

    /**
     * Get idUser4affectation
     *
     * @return int
     */
    public function getIdUser4affectation()
    {
        return $this->idUser4affectation;
    }

    /**
     * Set idUser4realisation
     *
     * @param integer $idUser4realisation
     *
     * @return ProjectEtapesOperationsIssuesRealisations
     */
    public function setIdUser4realisation($idUser4realisation)
    {
        $this->idUser4realisation = $idUser4realisation;

        return $this;
    }

    /**
     * Get idUser4realisation
     *
     * @return int
     */
    public function getIdUser4realisation()
    {
        return $this->idUser4realisation;
    }

    /**
     * Set idStatut
     *
     * @param integer $idStatut
     *
     * @return ProjectEtapesOperationsIssuesRealisations
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
     * Set idResultat
     *
     * @param integer $idResultat
     *
     * @return ProjectEtapesOperationsIssuesRealisations
     */
    public function setIdResultat($idResultat)
    {
        $this->idResultat = $idResultat;

        return $this;
    }

    /**
     * Get idResultat
     *
     * @return int
     */
    public function getIdResultat()
    {
        return $this->idResultat;
    }
}

