<?php

namespace CrmBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmEtapesRealisations
 *
 * @ORM\Table(name="crm_etapes_realisations")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\Common\CrmEtapesRealisationsRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class CrmEtapesRealisations
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
     * @ORM\Column(name="idEtape", type="integer", length=11)
     */
    private $idEtape = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="observations", type="text")
     */
    private $observations = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateaffectation", type="date")
     */
    private $dateaffectation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="daterealisation", type="date")
     */
    private $daterealisation;

    /**
     * @var int
     *
     * @ORM\Column(name="dureerealisation", type="integer", length=11)
     */
    private $dureerealisation = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser4affectation", type="integer", length=11)
     */
    private $idUser4affectation = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser4realisation", type="integer", length=11)
     */
    private $idUser4realisation = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idStatut", type="integer", length=11)
     */
    private $idStatut = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idResultat", type="integer", length=11)
     */
    private $idResultat = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionResultat", type="text")
     */
    private $descriptionResultat = '';


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
     * @return CrmEtapesRealisations
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
     * Set idEtape
     *
     * @param integer $idEtape
     *
     * @return CrmEtapesRealisations
     */
    public function setIdEtape($idEtape)
    {
        $this->idEtape = $idEtape ? $idEtape : $this->idEtape;

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
     * Set observations
     *
     * @param string $observations
     *
     * @return CrmEtapesRealisations
     */
    public function setObservations($observations)
    {
        $this->observations = $observations ? $observations : $this->observations;

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
     * Set dateaffectation
     *
     * @param \DateTime $dateaffectation
     *
     * @return CrmEtapesRealisations
     */
    public function setDateaffectation($dateaffectation)
    {
        $this->dateaffectation = $dateaffectation;

        return $this;
    }

    /**
     * Get dateaffectation
     *
     * @return \DateTime
     */
    public function getDateaffectation()
    {
        return $this->dateaffectation;
    }

    /**
     * Set daterealisation
     *
     * @param \DateTime $daterealisation
     *
     * @return CrmEtapesRealisations
     */
    public function setDaterealisation($daterealisation)
    {
        $this->daterealisation = $daterealisation;

        return $this;
    }

    /**
     * Get daterealisation
     *
     * @return \DateTime
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
     * @return CrmEtapesRealisations
     */
    public function setDureerealisation($dureerealisation)
    {
        $this->dureerealisation = $dureerealisation ? $dureerealisation : $this->dureerealisation;

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
     * @return CrmEtapesRealisations
     */
    public function setIdUser4affectation($idUser4affectation)
    {
        $this->idUser4affectation = $idUser4affectation ? $idUser4affectation : $this->idUser4affectation;

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
     * @return CrmEtapesRealisations
     */
    public function setIdUser4realisation($idUser4realisation)
    {
        $this->idUser4realisation = $idUser4realisation ? $idUser4realisation : $this->idUser4realisation;

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
     * @return CrmEtapesRealisations
     */
    public function setIdStatut($idStatut)
    {
        $this->idStatut = $idStatut ? $idStatut : $this->idStatut;

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
     * @return CrmEtapesRealisations
     */
    public function setIdResultat($idResultat)
    {
        $this->idResultat = $idResultat ? $idResultat : $this->idResultat;

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

    /**
     * Set descriptionResultat
     *
     * @param string $descriptionResultat
     *
     * @return CrmEtapesRealisations
     */
    public function setDescriptionResultat($descriptionResultat)
    {
        $this->descriptionResultat = $descriptionResultat ? $descriptionResultat : $this->descriptionResultat;

        return $this;
    }

    /**
     * Get descriptionResultat
     *
     * @return string
     */
    public function getDescriptionResultat()
    {
        return $this->descriptionResultat;
    }
}

