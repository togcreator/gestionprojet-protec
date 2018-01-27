<?php

namespace ProjectBundle\Entity\Agenda;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * AgendaWorker
 *
 * @ORM\Table(name="agendaworker")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Agenda\AgendaWorkerRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class AgendaWorker
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", length=20)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idTypeAgenda", type="integer", length=11)
     */
    private $idTypeAgenda = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idBU", type="integer", length=11)
     */
    private $idBU = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=10)
     */
    private $reference = '';

    /**
     * @var int
     *
     * @ORM\Column(name="idLieu", type="integer", length=11)
     */
    private $idLieu = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idChantier", type="integer", length=11)
     */
    private $idChantier = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idEntitej", type="integer", length=11)
     */
    private $idEntityJ = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idStrategie", type="integer", length=11)
     */
    private $idStrategie = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idZonage", type="integer", length=11)
     */
    private $idZonage = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idAgendaMaster", type="integer", length=11)
     */
    private $idAgendaMaster = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idProjet_operation", type="integer", length=11)
     */
    private $idProjetOperation = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idProjet_etape", type="integer", length=11)
     */
    private $idProjetEtape = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idProjet_jalon", type="integer", length=11)
     */
    private $idProjetJalon = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idProjet_issue", type="integer", length=11)
     */
    private $idProjetIssue = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idCRM_operation", type="integer", length=11)
     */
    private $idCRMOperation = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idCRM_etape", type="integer", length=11)
     */
    private $idCRMEtape = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idTypeuser", type="integer", length=11)
     */
    private $idTypeuser = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer", length=11)
     */
    private $idUser = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idWork", type="integer", length=11)
     */
    private $idWork = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idTypeWork", type="integer", length=11)
     */
    private $idTypeWork = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idPriorite", type="integer", length=11)
     */
    private $idPriorite = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idAlerte", type="integer", length=11)
     */
    private $idAlerte = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idEvenement", type="integer", length=11)
     */
    private $idEvenement = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=80)
     */
    private $titre = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datesaisie", type="date")
     */
    private $datesaisie;

    /**
     * @var int
     *
     * @ORM\Column(name="operateurSaisie", type="integer", length=11)
     */
    private $operateurSaisie = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="duree_prepa", type="integer", length=11)
     */
    private $dureePrepa = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="duree_cloture", type="integer", length=11)
     */
    private $dureeCloture = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebPrevue", type="date")
     */
    private $dateDebPrevue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinPrevue", type="date")
     */
    private $dateFinPrevue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebReelle", type="date")
     */
    private $dateDebReelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinReelle", type="date")
     */
    private $dateFinReelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureDebPrevue", type="time")
     */
    private $heureDebPrevue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureFinPrevue", type="time")
     */
    private $heureFinPrevue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureDebReelle", type="time")
     */
    private $heureDebReelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureFinReelle", type="time")
     */
    private $heureFinReelle;

    /**
     * @var int
     *
     * @ORM\Column(name="cloture", type="integer", length=11)
     */
    private $cloture = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCloture", type="date")
     */
    private $dateCloture;

    /**
     * @var int
     *
     * @ORM\Column(name="operateurCloture", type="integer", length=11)
     */
    private $operateurCloture = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="quoi", type="string", length=80)
     */
    private $quoi = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=80)
     */
    private $lieu = '';

    /**
     * @var string
     *
     * @ORM\Column(name="observations", type="text")
     */
    private $observations = '';

    /**
     * @var string
     *
     * @ORM\Column(name="image1", type="string", length=100)
     */
    private $image1 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="image2", type="string", length=100)
     */
    private $image2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="image3", type="string", length=100)
     */
    private $image3 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="image4", type="string", length=100)
     */
    private $image4 = '';

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idWriter", type="integer", length=11)
     */
    private $idWriter = 0;

    /**
     * @var bool
     *
     * @ORM\Column(name="valide", type="integer", length=4)
     */
    private $valide = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="version", type="integer", length=11)
     */
    private $version = 0;

    // contructor
    public function __construct() 
    {
        $this->heureDebPrevue = $this->heureFinPrevue = $this->heureDebReelle = $this->heureFinReelle = new \DateTime('00:00');
    }


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
     * Set idTypeAgenda
     *
     * @param integer $idTypeAgenda
     *
     * @return AgendaWorker
     */
    public function setIdTypeAgenda($idTypeAgenda)
    {
        $this->idTypeAgenda = $idTypeAgenda ? $idTypeAgenda: $this->idTypeAgenda;

        return $this;
    }

    /**
     * Get idTypeAgenda
     *
     * @return int
     */
    public function getIdTypeAgenda()
    {
        return $this->idTypeAgenda;
    }

    /**
     * Set idBU
     *
     * @param integer $idBU
     *
     * @return AgendaWorker
     */
    public function setIdBU($idBU)
    {
        $this->idBU = $idBU ? $idBU : $this->idBU;

        return $this;
    }

    /**
     * Get idBU
     *
     * @return int
     */
    public function getIdBU()
    {
        return $this->idBU;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return AgendaWorker
     */
    public function setReference($reference)
    {
        $this->reference = $reference ? $reference : $this->reference;

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
     * Set idLieu
     *
     * @param integer $idLieu
     *
     * @return AgendaWorker
     */
    public function setIdLieu($idLieu)
    {
        $this->idLieu = $idLieu ? $idLieu : $this->idLieu;

        return $this;
    }

    /**
     * Get idLieu
     *
     * @return int
     */
    public function getIdLieu()
    {
        return $this->idLieu;
    }

    /**
     * Set idChantier
     *
     * @param integer $idChantier
     *
     * @return AgendaWorker
     */
    public function setIdChantier($idChantier)
    {
        $this->idChantier = $idChantier ? $idChantier : $this->idChantier;

        return $this;
    }

    /**
     * Get idChantier
     *
     * @return int
     */
    public function getIdChantier()
    {
        return $this->idChantier;
    }

    /**
     * Set idEntityJ
     *
     * @param integer $idEntityJ
     *
     * @return AgendaWorker
     */
    public function setIdEntityJ($idEntityJ)
    {
        $this->idEntityJ = $idEntityJ ? $idEntityJ : $this->idEntityJ;

        return $this;
    }

    /**
     * Get idEntityJ
     *
     * @return int
     */
    public function getIdEntityJ()
    {
        return $this->idEntityJ;
    }

    /**
     * Set idStrategie
     *
     * @param integer $idStrategie
     *
     * @return AgendaWorker
     */
    public function setIdStrategie($idStrategie)
    {
        $this->idStrategie = $idStrategie ? $idStrategie : $this->idStrategie;

        return $this;
    }

    /**
     * Get idStrategie
     *
     * @return int
     */
    public function getIdStrategie()
    {
        return $this->idStrategie;
    }

    /**
     * Set idZonage
     *
     * @param integer $idZonage
     *
     * @return AgendaWorker
     */
    public function setIdZonage($idZonage)
    {
        $this->idZonage = $idZonage ? $idZonage : $this->idZonage;

        return $this;
    }

    /**
     * Get idZonage
     *
     * @return int
     */
    public function getIdZonage()
    {
        return $this->idZonage;
    }

    /**
     * Set idAgendaMaster
     *
     * @param integer $idAgendaMaster
     *
     * @return AgendaWorker
     */
    public function setIdAgendaMaster($idAgendaMaster)
    {
        $this->idAgendaMaster = $idAgendaMaster ? $idAgendaMaster : $this->idAgendaMaster;

        return $this;
    }

    /**
     * Get idAgendaMaster
     *
     * @return int
     */
    public function getIdAgendaMaster()
    {
        return $this->idAgendaMaster;
    }

    /**
     * Set idProjetOperation
     *
     * @param integer $idProjetOperation
     *
     * @return AgendaWorker
     */
    public function setIdProjetOperation($idProjetOperation)
    {
        $this->idProjetOperation = $idProjetOperation ? $idProjetOperation : $this->idProjetOperation;

        return $this;
    }

    /**
     * Get idProjetOperation
     *
     * @return int
     */
    public function getIdProjetOperation()
    {
        return $this->idProjetOperation;
    }

    /**
     * Set idProjetEtape
     *
     * @param integer $idProjetEtape
     *
     * @return AgendaWorker
     */
    public function setIdProjetEtape($idProjetEtape)
    {
        $this->idProjetEtape = $idProjetEtape;

        return $this;
    }

    /**
     * Get idProjetEtape
     *
     * @return int
     */
    public function getIdProjetEtape()
    {
        return $this->idProjetEtape;
    }

    /**
     * Set idProjetJalon
     *
     * @param integer $idProjetJalon
     *
     * @return AgendaWorker
     */
    public function setIdProjetJalon($idProjetJalon)
    {
        $this->idProjetJalon = $idProjetJalon;

        return $this;
    }

    /**
     * Get idProjetJalon
     *
     * @return int
     */
    public function getIdProjetJalon()
    {
        return $this->idProjetJalon;
    }

    /**
     * Set idProjetIssue
     *
     * @param integer $idProjetIssue
     *
     * @return AgendaWorker
     */
    public function setIdProjetIssue($idProjetIssue)
    {
        $this->idProjetIssue = $idProjetIssue;

        return $this;
    }

    /**
     * Get idProjetIssue
     *
     * @return int
     */
    public function getIdProjetIssue()
    {
        return $this->idProjetIssue;
    }

    /**
     * Set idCRMOperation
     *
     * @param integer $idCRMOperation
     *
     * @return AgendaWorker
     */
    public function setIdCRMOperation($idCRMOperation)
    {
        $this->idCRMOperation = $idCRMOperation;

        return $this;
    }

    /**
     * Get idCRMOperation
     *
     * @return int
     */
    public function getIdCRMOperation()
    {
        return $this->idCRMOperation;
    }

    /**
     * Set idCRMEtape
     *
     * @param integer $idCRMEtape
     *
     * @return AgendaWorker
     */
    public function setIdCRMEtape($idCRMEtape)
    {
        $this->idCRMEtape = $idCRMEtape;

        return $this;
    }

    /**
     * Get idCRMEtape
     *
     * @return int
     */
    public function getIdCRMEtape()
    {
        return $this->idCRMEtape;
    }

    /**
     * Set idTypeuser
     *
     * @param integer $idTypeuser
     *
     * @return AgendaWorker
     */
    public function setIdTypeuser($idTypeuser)
    {
        $this->idTypeuser = $idTypeuser;

        return $this;
    }

    /**
     * Get idTypeuser
     *
     * @return int
     */
    public function getIdTypeuser()
    {
        return $this->idTypeuser;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return AgendaWorker
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
     * Set idWork
     *
     * @param integer $idWork
     *
     * @return AgendaWorker
     */
    public function setIdWork($idWork)
    {
        $this->idWork = $idWork;

        return $this;
    }

    /**
     * Get idWork
     *
     * @return int
     */
    public function getIdWork()
    {
        return $this->idWork;
    }

    /**
     * Set idTypeWork
     *
     * @param integer $idTypeWork
     *
     * @return AgendaWorker
     */
    public function setIdTypeWork($idTypeWork)
    {
        $this->idTypeWork = $idTypeWork;

        return $this;
    }

    /**
     * Get idWork
     *
     * @return int
     */
    public function getIdTypeWork()
    {
        return $this->idTypeWork;
    }

    /**
     * Set idPriorite
     *
     * @param integer $idPriorite
     *
     * @return AgendaWorker
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
     * Set idAlerte
     *
     * @param integer $idAlerte
     *
     * @return AgendaWorker
     */
    public function setIdAlerte($idAlerte)
    {
        $this->idAlerte = $idAlerte;

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
     * Set idEvenement
     *
     * @param integer $idEvenement
     *
     * @return AgendaWorker
     */
    public function setIdEvenement($idEvenement)
    {
        $this->idEvenement = $idEvenement;

        return $this;
    }

    /**
     * Get idEvenement
     *
     * @return int
     */
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return AgendaWorker
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set datesaisie
     *
     * @param \DateTime $datesaisie
     *
     * @return AgendaWorker
     */
    public function setDatesaisie($datesaisie)
    {
        $this->datesaisie = $datesaisie;

        return $this;
    }

    /**
     * Get datesaisie
     *
     * @return \DateTime
     */
    public function getDatesaisie()
    {
        return $this->datesaisie;
    }

    /**
     * Set operateurSaisie
     *
     * @param integer $operateurSaisie
     *
     * @return AgendaWorker
     */
    public function setOperateurSaisie($operateurSaisie)
    {
        $this->operateurSaisie = $operateurSaisie;

        return $this;
    }

    /**
     * Get operateurSaisie
     *
     * @return int
     */
    public function getOperateurSaisie()
    {
        return $this->operateurSaisie;
    }

    /**
     * Set dureePrepa
     *
     * @param integer $dureePrepa
     *
     * @return AgendaWorker
     */
    public function setDureePrepa($dureePrepa)
    {
        $this->dureePrepa = $dureePrepa;

        return $this;
    }

    /**
     * Get dureePrepa
     *
     * @return int
     */
    public function getDureePrepa()
    {
        return $this->dureePrepa;
    }

    /**
     * Set dureeCloture
     *
     * @param integer $dureeCloture
     *
     * @return AgendaWorker
     */
    public function setDureeCloture($dureeCloture)
    {
        $this->dureeCloture = $dureeCloture;

        return $this;
    }

    /**
     * Get dureeCloture
     *
     * @return int
     */
    public function getDureeCloture()
    {
        return $this->dureeCloture;
    }

    /**
     * Set dateDebPrevue
     *
     * @param \DateTime $dateDebPrevue
     *
     * @return AgendaWorker
     */
    public function setDateDebPrevue($dateDebPrevue)
    {
        $this->dateDebPrevue = $dateDebPrevue;

        return $this;
    }

    /**
     * Get dateDebPrevue
     *
     * @return \DateTime
     */
    public function getDateDebPrevue()
    {
        return $this->dateDebPrevue;
    }

    /**
     * Set dateFinPrevue
     *
     * @param \DateTime $dateFinPrevue
     *
     * @return AgendaWorker
     */
    public function setDateFinPrevue($dateFinPrevue)
    {
        $this->dateFinPrevue = $dateFinPrevue;

        return $this;
    }

    /**
     * Get dateFinPrevue
     *
     * @return \DateTime
     */
    public function getDateFinPrevue()
    {
        return $this->dateFinPrevue;
    }

    /**
     * Set dateDebReelle
     *
     * @param \DateTime $dateDebReelle
     *
     * @return AgendaWorker
     */
    public function setDateDebReelle($dateDebReelle)
    {
        $this->dateDebReelle = $dateDebReelle;

        return $this;
    }

    /**
     * Get dateDebReelle
     *
     * @return \DateTime
     */
    public function getDateDebReelle()
    {
        return $this->dateDebReelle;
    }

    /**
     * Set dateFinReelle
     *
     * @param \DateTime $dateFinReelle
     *
     * @return AgendaWorker
     */
    public function setDateFinReelle($dateFinReelle)
    {
        $this->dateFinReelle = $dateFinReelle;

        return $this;
    }

    /**
     * Get dateFinReelle
     *
     * @return \DateTime
     */
    public function getDateFinReelle()
    {
        return $this->dateFinReelle;
    }

    /**
     * Set heureDebPrevue
     *
     * @param \DateTime $heureDebPrevue
     *
     * @return AgendaWorker
     */
    public function setHeureDebPrevue($heureDebPrevue)
    {
        $this->heureDebPrevue = $heureDebPrevue ? $heureDebPrevue : $this->heureDebPrevue;

        return $this;
    }

    /**
     * Get heureDebPrevue
     *
     * @return \DateTime
     */
    public function getHeureDebPrevue()
    {
        return $this->heureDebPrevue;
    }

    /**
     * Set heureFinPrevue
     *
     * @param \DateTime $heureFinPrevue
     *
     * @return AgendaWorker
     */
    public function setHeureFinPrevue($heureFinPrevue)
    {
        $this->heureFinPrevue = $heureFinPrevue ? $heureFinPrevue : $this->heureFinPrevue;

        return $this;
    }

    /**
     * Get heureFinPrevue
     *
     * @return \DateTime
     */
    public function getHeureFinPrevue()
    {
        return $this->heureFinPrevue;
    }

    /**
     * Set heureDebReelle
     *
     * @param \DateTime $heureDebReelle
     *
     * @return AgendaWorker
     */
    public function setHeureDebReelle($heureDebReelle)
    {
        $this->heureDebReelle = $heureDebReelle ? $heureDebReelle : $this->heureDebReelle;

        return $this;
    }

    /**
     * Get heureDebReelle
     *
     * @return \DateTime
     */
    public function getHeureDebReelle()
    {
        return $this->heureDebReelle;
    }

    /**
     * Set heureFinReelle
     *
     * @param \DateTime $heureFinReelle
     *
     * @return AgendaWorker
     */
    public function setHeureFinReelle($heureFinReelle)
    {
        $this->heureFinReelle = $heureFinReelle ? $heureFinReelle : $this->heureFinReelle;

        return $this;
    }

    /**
     * Get heureFinReelle
     *
     * @return \DateTime
     */
    public function getHeureFinReelle()
    {
        return $this->heureFinReelle;
    }

    /**
     * Set cloture
     *
     * @param integer $cloture
     *
     * @return AgendaWorker
     */
    public function setCloture($cloture)
    {
        $this->cloture = $cloture;

        return $this;
    }

    /**
     * Get cloture
     *
     * @return int
     */
    public function getCloture()
    {
        return $this->cloture;
    }

    /**
     * Set dateCloture
     *
     * @param \DateTime $dateCloture
     *
     * @return AgendaWorker
     */
    public function setDateCloture($dateCloture)
    {
        $this->dateCloture = $dateCloture;

        return $this;
    }

    /**
     * Get dateCloture
     *
     * @return \DateTime
     */
    public function getDateCloture()
    {
        return $this->dateCloture;
    }

    /**
     * Set operateurCloture
     *
     * @param integer $operateurCloture
     *
     * @return AgendaWorker
     */
    public function setOperateurCloture($operateurCloture)
    {
        $this->operateurCloture = $operateurCloture;

        return $this;
    }

    /**
     * Get operateurCloture
     *
     * @return int
     */
    public function getOperateurCloture()
    {
        return $this->operateurCloture;
    }

    /**
     * Set quoi
     *
     * @param string $quoi
     *
     * @return AgendaWorker
     */
    public function setQuoi($quoi)
    {
        $this->quoi = $quoi;

        return $this;
    }

    /**
     * Get quoi
     *
     * @return string
     */
    public function getQuoi()
    {
        return $this->quoi;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return AgendaWorker
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set observations
     *
     * @param string $observations
     *
     * @return AgendaWorker
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
     * Set image1
     *
     * @param string $image1
     *
     * @return AgendaWorker
     */
    public function setImage1($image1)
    {
        $this->image1 = $image1;

        return $this;
    }

    /**
     * Get image1
     *
     * @return string
     */
    public function getImage1()
    {
        return $this->image1;
    }

    /**
     * Set image2
     *
     * @param string $image2
     *
     * @return AgendaWorker
     */
    public function setImage2($image2)
    {
        $this->image2 = $image2;

        return $this;
    }

    /**
     * Get image2
     *
     * @return string
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * Set image3
     *
     * @param string $image3
     *
     * @return AgendaWorker
     */
    public function setImage3($image3)
    {
        $this->image3 = $image3;

        return $this;
    }

    /**
     * Get image3
     *
     * @return string
     */
    public function getImage3()
    {
        return $this->image3;
    }

    /**
     * Set image4
     *
     * @param string $image4
     *
     * @return AgendaWorker
     */
    public function setImage4($image4)
    {
        $this->image4 = $image4;

        return $this;
    }

    /**
     * Get image4
     *
     * @return string
     */
    public function getImage4()
    {
        return $this->image4;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return AgendaWorker
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return AgendaWorker
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set idWriter
     *
     * @param integer $idWriter
     *
     * @return AgendaWorker
     */
    public function setIdWriter($idWriter)
    {
        $this->idWriter = $idWriter;

        return $this;
    }

    /**
     * Get idWriter
     *
     * @return int
     */
    public function getIdWriter()
    {
        return $this->idWriter;
    }

    /**
     * Set valide
     *
     * @param integer $valide
     *
     * @return AgendaWorker
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return bool
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return AgendaWorker
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

    // minimum required by angenda
    public static function MinAgenda (array $array, $agenda = null) 
    {        
        if(!count($array)) return;

        // setting agenda
        $accessor = PropertyAccess::createPropertyAccessor();

        // agenda
        if( $agenda == null ) {
            $agenda = new self;
            $array['datesaisie'] = new \DateTime('now ' .date('e')); // date de saisie
        }

        foreach($array as $key => $value)
            if( property_exists($agenda, $key) )
                $accessor->setValue($agenda, $key, $value);
        return $agenda;
    }
}