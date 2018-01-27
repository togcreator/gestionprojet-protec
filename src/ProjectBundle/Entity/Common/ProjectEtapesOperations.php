<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectEtapesOperations
 *
 * @ORM\Table(name="projet_etapes_operations")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectEtapesOperationsRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class ProjectEtapesOperations
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
     * @ORM\Column(name="idAgenda", type="integer", length=11, nullable=true)
     */
    private $idAgenda;

    /**
     * @var int
     *
     * @ORM\Column(name="idJalon_prevu", type="integer", length=11, nullable=true)
     */
    private $idJalonPrevu = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idJalon_actuel", type="integer", length=11, nullable=true)
     */
    private $idJalonActuel = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=80)
     */
    private $object;

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
     * @ORM\Column(name="dureeprevue", type="integer", length=11)
     */
    private $dureeprevue = 0;

    /**
     * @var \DateTime
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
     * @ORM\Column(name="dureereelle", type="integer", length=11)
     */
    private $dureereelle = 0;

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
    private $journeesHommesreelles = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idPriorite", type="integer", length=11)
     */
    private $idPriorite;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="ProjectBundle\Entity\Back\Priorites", fetch="EAGER")
     * @ORM\JoinColumn(name="idPriorite", referencedColumnName="id")
     */
    private $priorites;

    /**
     * @var int
     *
     * @ORM\Column(name="idStatut", type="integer", length=11)
     */
    private $idStatut;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="\ProjectBundle\Entity\Back\Statut", fetch="EAGER")
     * @ORM\JoinColumn(name="idStatut", referencedColumnName="id")
     */
    private $statuts;

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
     * Set priorites
     *
     * @param object $priorites
     *
     * @return ProjectEtapesOperations
     */
    public function setPriorites($priorites)
    {
        $this->priorites = $priorites;

        return $this;
    }

    /**
     * Get priorites
     *
     * @return string
     */
    public function getPriorites()
    {
        return $this->priorites;
    }

    /**
     * Set idProjectVersion
     *
     * @param integer $idProjectVersion
     *
     * @return ProjectEtapesOperations
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
     * @return ProjectEtapesOperations
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
     * Set idAgenda
     *
     * @param integer $idAgenda
     *
     * @return ProjectEtapesOperations
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
     * Set idJalonPrevu
     *
     * @param integer $idJalonPrevu
     *
     * @return ProjectEtapesOperations
     */
    public function setIdJalonPrevu($idJalonPrevu)
    {
        $this->idJalonPrevu = $idJalonPrevu ? $idJalonPrevu : $this->idJalonPrevu;

        return $this;
    }

    /**
     * Get idJalonPrevu
     *
     * @return int
     */
    public function getIdJalonPrevu()
    {
        return $this->idJalonPrevu;
    }

    /**
     * Set idJalonActuel
     *
     * @param integer $idJalonActuel
     *
     * @return ProjectEtapesOperations
     */
    public function setIdJalonActuel($idJalonActuel)
    {
        $this->idJalonActuel = $idJalonActuel ? $idJalonActuel : $this->idJalonActuel;

        return $this;
    }

    /**
     * Get idJalonActuel
     *
     * @return int
     */
    public function getIdJalonActuel()
    {
        return $this->idJalonActuel;
    }

    /**
     * Set object
     *
     * @param string $object
     *
     * @return ProjectEtapesOperations
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return string
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ProjectEtapesOperations
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
     * @return ProjectEtapesOperations
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
     * @return ProjectEtapesOperations
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
     * @return ProjectEtapesOperations
     */
    public function setDureeprevue($dureeprevue)
    {
        $this->dureeprevue = $dureeprevue ? $dureeprevue : $this->dureeprevue;

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
     * @param \DateTime $datedebutreelle
     *
     * @return ProjectEtapesOperations
     */
    public function setDatedebutreelle($datedebutreelle)
    {
        $this->datedebutreelle = $datedebutreelle;

        return $this;
    }

    /**
     * Get datedebutreelle
     *
     * @return \DateTime
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
     * @return ProjectEtapesOperations
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
     * @return ProjectEtapesOperations
     */
    public function setDureereelle($dureereelle)
    {
        $datedebut = is_object($this->getDatedebutreelle()) ? $this->getDatedebutreelle() : new \DateTime($this->getDatedebutreelle());
        $datefin = is_object($this->getDatefinreelle()) ? $this->getDatefinreelle() : new \DateTime($this->getDatefinreelle());

        $this->dureereelle = date_diff($datedebut, $datefin)->format('%R%a');

        return $this;
    }

    /**
     * Get dureereelle
     *
     * @return int
     */
    public function getDureereelle()
    {
        $this->setDureereelle(0);

        return $this->dureereelle;
    }

    /**
     * Set journeesHommesprevues
     *
     * @param float $journeesHommesprevues
     *
     * @return ProjectEtapesOperations
     */
    public function setJourneesHommesprevues($journeesHommesprevues)
    {
        $this->journeesHommesprevues = $journeesHommesprevues ? $journeesHommesprevues : $this->journeesHommesprevues;

        return $this;
    }

    /**
     * Get journeesHommesprevues
     *
     * @return float
     */
    public function getJourneesHommesprevues()
    {
        return $this->journeesHommesprevues;
    }

    /**
     * Set journeesHommesreelles
     *
     * @param float $journeesHommesreelles
     *
     * @return ProjectEtapesOperations
     */
    public function setJourneesHommesreelles($journeesHommesreelles)
    {
        $this->journeesHommesreelles = $journeesHommesreelles ? $journeesHommesreelles : $this->journeesHommesreelles;

        return $this;
    }

    /**
     * Get journeesHommesreelles
     *
     * @return float
     */
    public function getJourneesHommesreelles()
    {
        return $this->journeesHommesreelles;
    }

    /**
     * Set idStatut
     *
     * @param integer $idStatut
     *
     * @return ProjectEtapesOperations
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
     * @return ProjectEtapesOperations
     */
    public function setIdResultat($idResultat)
    {
        $this->idResultat = $idResultat;

        return $this;
    }

    /**
     * Set statuts
     *
     * @param integer $statuts
     *
     * @return ProjectEtapesOperations
     */
    public function setStatuts($statuts)
    {
        $this->statuts = $statuts;

        return $this;
    }

    /**
     * Get statuts
     *
     * @return int
     */
    public function getStatuts()
    {
        return $this->statuts;
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
     * Set idPriorite
     *
     * @param integer $idPriorite
     *
     * @return ProjectEtapesOperations
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
     * @return ProjectEtapesOperations
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
     * Set Etape
     *
     * @param integer $etape
     *
     * @return ProjectEtapesOperations
     */
    public function setEtape($etape)
    {
        $this->etape = $etape;

        return $this;
    }

    /**
     * Get etape
     *
     * @return object
     */
    public function getEtape()
    {
        return $this->etape;
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
     * @param string $docs
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
     * @return string
     */
    public function getDocs()
    {
        return $this->docs;
    }

    
}

