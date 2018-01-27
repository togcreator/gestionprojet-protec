<?php

namespace CrmBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmEtapes
 *
 * @ORM\Table(name="crm_etapes")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\Common\CrmEtapesRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class CrmEtapes
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
     * @ORM\Column(name="idCRM", type="integer", length=11, nullable=true)
     */
    private $idCRM;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="CrmDossier", fetch="EAGER")
     * @ORM\JoinColumn(name="idCRM", referencedColumnName="id")
     */
    private $crm;

    /**
     * @var int
     *
     * @ORM\Column(name="idCycle", type="integer", length=11, nullable=true)
     */
    private $idCycle;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=80, nullable=true)
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=20, nullable=true)
     */
    private $code;

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
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="date")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebutprevue", type="date")
     */
    private $datedebutprevue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefinprevue", type="date")
     */
    private $datefinprevue;

    /**
     * @var int
     *
     * @ORM\Column(name="dureeprevue", type="integer", nullable=true)
     */
    private $dureeprevue;

    /**
     * @var string
     *
     * @ORM\Column(name="datedebutreelle", type="date")
     */
    private $datedebutreelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefinreelle", type="date")
     */
    private $datefinreelle;

    /**
     * @var int
     *
     * @ORM\Column(name="dureereelle", type="integer", nullable=true)
     */
    private $dureereelle;

    /**
     * @var int
     *
     * @ORM\Column(name="idStatut", type="integer")
     */
    private $idStatut;

    /**
     * @var int
     *
     * @ORM\Column(name="idResultat", type="integer")
     */
    private $idResultat;

    /**
     * @var int
     *
     * @ORM\Column(name="descriptionResultat", type="text")
     */
    private $descriptionResultat;

    /**
     * @var int
     *
     * @ORM\Column(name="flagAction", type="integer")
     */
    private $flagAction = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="flagIdee", type="integer")
     */
    private $flagIdee = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="flagInformation", type="integer")
     */
    private $flagInformation = 0;

    /**
     * @var object
     */
    private $user4affectation;



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
     * @return CrmEtapes
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
     * @param object $crm
     *
     * @return CrmEtapes
     */
    public function setCrm($crm)
    {
        $this->crm = $crm;

        return $this;
    }

    /**
     * Get idCRM
     *
     * @return int
     */
    public function getCrm()
    {
        return $this->crm;
    }

    /**
     * Set idCycle
     *
     * @param integer $idCycle
     *
     * @return CrmEtapes
     */
    public function setIdCycle($idCycle)
    {
        $this->idCycle = $idCycle;

        return $this;
    }

    /**
     * Get idCycle
     *
     * @return int
     */
    public function getIdCycle()
    {
        return $this->idCycle;
    }

    /**
     * Set objet
     *
     * @param string $objet
     *
     * @return CrmEtapes
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return CrmEtapes
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
     * Set reference
     *
     * @param string $reference
     *
     * @return CrmEtapes
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
     * @return CrmEtapes
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return CrmEtapes
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
     * Set datedebutprevue
     *
     * @param \DateTime $datedebutprevue
     *
     * @return CrmEtapes
     */
    public function setDatedebutprevue($datedebutprevue)
    {
        $this->datedebutprevue = $datedebutprevue;

        return $this;
    }

    /**
     * Get datedebutprevue
     *
     * @return \DateTime
     */
    public function getDatedebutprevue()
    {
        return $this->datedebutprevue;
    }

    /**
     * Set datefinprevue
     *
     * @param \DateTime $datefinprevue
     *
     * @return CrmEtapes
     */
    public function setDatefinprevue($datefinprevue)
    {
        $this->datefinprevue = $datefinprevue;

        return $this;
    }

    /**
     * Get datefinprevue
     *
     * @return \DateTime
     */
    public function getDatefinprevue()
    {
        return $this->datefinprevue;
    }

    /**
     * Set dureeprevue
     *
     * @param integer $dureeprevue
     *
     * @return CrmEtapes
     */
    public function setDureeprevue($dureeprevue)
    {
        $this->dureeprevue = $dureeprevue;

        return $this;
    }

    /**
     * Get dureeprevue
     *
     * @return int
     */
    public function getDureeprevue()
    {
        return $this->dureeprevue;
    }

    /**
     * Set datedebutreelle
     *
     * @param string $datedebutreelle
     *
     * @return CrmEtapes
     */
    public function setDatedebutreelle($datedebutreelle)
    {
        $this->datedebutreelle = $datedebutreelle;

        return $this;
    }

    /**
     * Get datedebutreelle
     *
     * @return string
     */
    public function getDatedebutreelle()
    {
        return $this->datedebutreelle;
    }

    /**
     * Set datefinreelle
     *
     * @param \DateTime $datefinreelle
     *
     * @return CrmEtapes
     */
    public function setDatefinreelle($datefinreelle)
    {
        $this->datefinreelle = $datefinreelle;

        return $this;
    }

    /**
     * Get datefinreelle
     *
     * @return \DateTime
     */
    public function getDatefinreelle()
    {
        return $this->datefinreelle;
    }

    /**
     * Set dureereelle
     *
     * @param integer $dureereelle
     *
     * @return CrmEtapes
     */
    public function setDureereelle($dureereelle)
    {
        $this->dureereelle = $dureereelle;

        return $this;
    }

    /**
     * Get dureereelle
     *
     * @return int
     */
    public function getDureereelle()
    {
        return $this->dureereelle;
    }

    /**
     * Set idStatut
     *
     * @param integer $idStatut
     *
     * @return CrmEtapes
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
     * @return CrmEtapes
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

    /**
     * Set descriptionResultat
     *
     * @param text $descriptionResultat
     *
     * @return CrmEtapes
     */
    public function setDescriptionResultat($descriptionResultat)
    {
        $this->descriptionResultat = $descriptionResultat;

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

    /**
     * Set flagAction
     *
     * @param integer $flagAction
     *
     * @return CrmEtapes
     */
    public function setFlagAction($flagAction)
    {
        $this->flagAction = $flagAction;

        return $this;
    }

    /**
     * Get flagAction
     *
     * @return int
     */
    public function getFlagAction()
    {
        return $this->flagAction;
    }

    /**
     * Set flagIdee
     *
     * @param integer $flagIdee
     *
     * @return CrmEtapes
     */
    public function setFlagIdee($flagIdee)
    {
        $this->flagIdee = $flagIdee ? $flagIdee : $this->flagIdee;

        return $this;
    }

    /**
     * Get flagIdee
     *
     * @return int
     */
    public function getFlagIdee()
    {
        return $this->flagIdee;
    }

    /**
     * Set flagInformation
     *
     * @param integer $flagInformation
     *
     * @return CrmEtapes
     */
    public function setFlagInformation($flagInformation)
    {
        $this->flagInformation = $flagInformation ? $flagInformation : $this->flagInformation;

        return $this;
    }

    /**
     * Get flagInformation
     *
     * @return int
     */
    public function getFlagInformation()
    {
        return $this->flagInformation;
    }

    /**
     * Set user4affectation
     *
     * @param object $user4affectation
     *
     * @return CrmEtapes
     */
    public function setUser4affectation($user4affectation)
    {
        $this->user4affectation = $user4affectation;

        return $this;
    }

    /**
     * Get user4affectation
     *
     * @return object
     */
    public function getUser4affectation()
    {
        return $this->user4affectation;
    }

}