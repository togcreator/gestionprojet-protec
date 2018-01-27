<?php

namespace CrmBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmEtapesOperations
 *
 * @ORM\Table(name="crm_etapes_operations")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\Common\CrmEtapesOperationsRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class CrmEtapesOperations
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
     */
    private $crm;

    /**
     * @var int
     *
     * @ORM\Column(name="idDetailActivity", type="integer", length=11, nullable=true)
     */
    private $idDetailActivity = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idCycle", type="integer", length=11, nullable=true)
     */
    private $idCycle;

    /**
     * @var int
     *
     * @ORM\Column(name="idCycledetail", type="integer", length=11, nullable=true)
     */
    private $idCycledetail;

    /**  
     * @var CycleDetails
     */
    private $cycledetail;

    /**
     * @var int
     *
     * @ORM\Column(name="idAgenda", type="integer", length=11, nullable=true)
     */
    private $idAgenda = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idStatut", type="integer", length=11, nullable=true)
     */
    private $idStatut;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=80, nullable=true)
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
     * @var float
     *
     * @ORM\Column(name="journeesHommeprevues", type="float")
     */
    private $journeesHommesprevues = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="journeesHommereelles", type="float")
     */
    private $journeesHommesreelle = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idPriorite", type="integer", length=11)
     */
    private $idPriorite;

    /**
     * @var int
     *
     * @ORM\Column(name="idResultat", type="integer", length=11)
     */
    private $idResultat;

    /**
     * @var int
     *
     * @ORM\Column(name="idAlerte", type="integer", length=11)
     */
    private $idAlerte;

    /**
     * @var int
     *
     * @ORM\Column(name="idRappel", type="integer", length=11)
     */
    private $idRappel = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idCommande", type="integer", length=11)
     */
    private $idCommande = 0;

    /**
     * @var int
     */
    private $user4affectation;

    /**
     * @var \DateTime
     */
    private $userDate;

    /**
     * @var object
     */
    private $docs;

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
     * @return CrmEtapesOperations
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
     * Set idCycle
     *
     * @param integer $idCycle
     *
     * @return CrmEtapesOperations
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
     * Set idCycledetail
     *
     * @param integer $idCycledetail
     *
     * @return CrmEtapesOperations
     */
    public function setIdCycledetail($idCycledetail)
    {
        $this->idCycledetail = $idCycledetail;

        return $this;
    }

    /**
     * Get idCycledetail
     *
     * @return int
     */
    public function getIdCycledetail()
    {
        return $this->idCycledetail;
    }

    /**
     * Set cycledetail
     *
     * @param integer $cycledetail
     *
     * @return CrmEtapesOperations
     */
    public function setCycledetail($cycledetail)
    {
        $this->cycledetail = $cycledetail;

        return $this;
    }

    /**
     * Get cycledetail
     *
     * @return int
     */
    public function getCycledetail()
    {
        return $this->cycledetail;
    }

    /**
     * Set idDetailActivity
     *
     * @param integer $idDetailActivity
     *
     * @return CrmEtapesOperations
     */
    public function setIdDetailActivity($idDetailActivity)
    {
        $this->idDetailActivity = $idDetailActivity ? $idDetailActivity : $this->idDetailActivity;

        return $this;
    }

    /**
     * Get idDetailActivity
     *
     * @return int
     */
    public function getIdDetailActivity()
    {
        return $this->idDetailActivity;
    }

    /**
     * Set idAgenda
     *
     * @param integer $idAgenda
     *
     * @return CrmEtapesOperations
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
     * Set objet
     *
     * @param string $objet
     *
     * @return CrmEtapesOperations
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
     * Set description
     *
     * @param string $description
     *
     * @return CrmEtapesOperations
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
     * Set datedebutprevue
     *
     * @param \DateTime $datedebutprevue
     *
     * @return CrmEtapesOperations
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
     * @return CrmEtapesOperations
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
     * @return CrmEtapesOperations
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
     * @return CrmEtapesOperations
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
     * @return CrmEtapesOperations
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
     * @return CrmEtapesOperations
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
     * Set journeesHommesprevues
     *
     * @param integer $journeesHommesprevues
     *
     * @return CrmEtapesOperations
     */
    public function setJourneesHommesprevues($journeesHommesprevues)
    {
        $this->journeesHommesprevues = $journeesHommesprevues ? $journeesHommesprevues : $this->journeesHommesprevues;

        return $this;
    }

    /**
     * Get journeesHommesprevues
     *
     * @return int
     */
    public function getJourneesHommesprevues()
    {
        return $this->journeesHommesprevues;
    }

    /**
     * Set journeesHommesreelle
     *
     * @param integer $journeesHommesreelle
     *
     * @return CrmEtapesOperations
     */
    public function setJourneesHommesreelle($journeesHommesreelle)
    {
        $this->journeesHommesreelle = $journeesHommesreelle ? $journeesHommesreelle : $this->journeesHommesreelle;

        return $this;
    }

    /**
     * Get journeesHommesreelle
     *
     * @return int
     */
    public function getJourneesHommesreelle()
    {
        return $this->journeesHommesreelle;
    }

    /**
     * Set idStatut
     *
     * @param integer $idStatut
     *
     * @return CrmEtapesOperations
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
     * Set idPriorite
     *
     * @param integer $idPriorite
     *
     * @return CrmEtapesOperations
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
     * Set idResultat
     *
     * @param integer $idResultat
     *
     * @return CrmEtapesOperations
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
     * Set idAlerte
     *
     * @param integer $idAlerte
     *
     * @return CrmEtapesOperations
     */
    public function setIdAlerte($idAlerte)
    {
        $this->idAlerte = $idAlerte ? $idAlerte : $this->idAlerte;

        return $this;
    }

    /**
     * Get idAlerte
     *
     * @return int
     */
    public function getIdAlerte()
    {
        return $this->idAlerte;
    }

    /**
     * Set idRappel
     *
     * @param integer $idRappel
     *
     * @return CrmEtapesOperations
     */
    public function setIdRappel($idRappel)
    {
        $this->idRappel = $idRappel ? $idRappel : $this->idRappel;

        return $this;
    }

    /**
     * Get idRappel
     *
     * @return int
     */
    public function getIdRappel()
    {
        return $this->idRappel;
    }

    /**
     * Set idCommande
     *
     * @param integer $idCommande
     *
     * @return CrmEtapesOperations
     */
    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande ? $idCommande : $this->idCommande;

        return $this;
    }

    /**
     * Get idCommande
     *
     * @return int
     */
    public function getIdCommande()
    {
        return $this->idCommande;
    }

    /**
     * Set user4affectation
     *
     * @param integer $user4affectation
     *
     * @return ProjectEtapesOperations
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

    /**
     * Set userDate
     *
     * @param datetime $userDate
     *
     * @return ProjectEtapesOperations
     */
    public function setUserDate($userDate)
    {
        $this->userDate = $userDate;

        return $this;
    }

    /**
     * Get userDate
     *
     * @return object
     */
    public function getUserDate()
    {
        return $this->userDate;
    }

    /**
     * Set docs
     *
     * @param datetime $docs
     *
     * @return ProjectEtapesOperations
     */
    public function setDocs($docs)
    {
        $this->docs = $docs;

        return $this;
    }

    /**
     * Get docs
     *
     * @return object
     */
    public function getDocs()
    {
        return $this->docs;
    }
}