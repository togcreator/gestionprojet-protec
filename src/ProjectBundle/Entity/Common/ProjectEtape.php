<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectEtape
 *
 * @ORM\Table(name="projet_etapes")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectEtapeRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class ProjectEtape
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
     */
    private $idEtape;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="\ProjectBundle\Entity\Common\Project", inversedBy="etape", fetch="EAGER")
     * @ORM\JoinColumn(name="idProjetVersion", referencedColumnName="id")
     */
    private $projet;

    /**
     * @var int
     *
     * @ORM\Column(name="idProjetVersion", type="integer", length=11)
     */
    private $idProjetVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=80)
     */
    private $object;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=20)
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
     * @ORM\Column(name="dureereelle", type="integer", length=10)
     */
    private $dureereelle = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idStatut", type="integer", length=11)
     */
    private $idStatut;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="ProjectBundle\Entity\Back\Statut")
     * @ORM\JoinColumn(name="idStatut", referencedColumnName="id")
     */
    private $statuts;

    /**
     * @var int
     *
     * @ORM\Column(name="idResultat", type="integer", length=11)
     */
    private $idResultat = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="flagAction", type="integer", length=11)
     */
    private $flagAction = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="flagIdee", type="integer", length=11)
     */
    private $flagIdee = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="flagInformation", type="integer", length=11)
     */
    private $flagInformation = 0;

    /**
     * @var object
     */
    private $user4affectation;

    /**
     * @var object
     */
    private $operations = [];

    /**
     * @var object
     */
    private $docs = [];

    /**
     * @var object
     */
    private $notes = [];

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
     * Set idEtape
     *
     * @param integer $idEtape
     *
     * @return ProjectEtape
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
        return $this->getId();
    }

    /**
     * Set idProjetVersion
     *
     * @param integer $idProjetVersion
     *
     * @return ProjectEtape
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
     * Set object
     *
     * @param string $object
     *
     * @return ProjectEtape
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
     * Set docs
     *
     * @param string $docs
     *
     * @return ProjectEtape
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

    /**
     * Set code
     *
     * @param string $code
     *
     * @return ProjectEtape
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
     * @return ProjectEtape
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
     * @return ProjectEtape
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
     * @return ProjectEtape
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
     * @return ProjectEtape
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
     * @return ProjectEtape
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
     * @return ProjectEtape
     */
    public function setDureeprevue($dureeprevue)
    {
        $this->dureeprevue = $dureeprevue ? $dureeprevue: $this->dureeprevue;

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
     * @return ProjectEtape
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
     * @return ProjectEtape
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
     * @return ProjectEtape
     */
    public function setDureereelle($dureereelle)
    {
        $this->dureereelle = $dureereelle ? $dureereelle : $this->dureereelle;

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
     * @return ProjectEtape
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
     * Set statuts
     *
     * @param integer $statuts
     *
     * @return ProjectEtape
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
     * Set idResultat
     *
     * @param integer $idResultat
     *
     * @return ProjectEtape
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
     * Set flagAction
     *
     * @param integer $flagAction
     *
     * @return ProjectEtape
     */
    public function setFlagAction($flagAction)
    {
        $this->flagAction = $flagAction ? $flagAction : $this->flagAction;

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
     * @return ProjectEtape
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
     * @return ProjectEtape
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
     * Set project
     *
     * @param Project $projet
     *
     * @return ProjectEtape
     */
    public function setProjet($projet)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return Project
     */
    public function getProjet()
    {
        return $this->projet;
    }

    /**
     * Set operations
     *
     * @param Project $operations
     *
     * @return ProjectEtape
     */
    public function setOperations($operations)
    {
        $this->operations = $operations;

        return $this;
    }

    /**
     * Get operations
     *
     * @return Project
     */
    public function getOperations()
    {
        return $this->operations;
    }

    /**
     * Set user4affectation
     *
     * @param object $user4affectation
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
     * Set notes
     *
     * @param Note $notes
     *
     * @return ProjectEtapesOperations
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return object
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set etapejalons
     *
     * @param Jalons $etapejalons
     *
     * @return ProjectEtapesOperations
     */
    public function setEtapejalons($etapejalons)
    {
        $this->etapejalons = $etapejalons;

        return $this;
    }

    /**
     * Get etapejalons
     *
     * @return object
     */
    public function getEtapejalons()
    {
        return $this->etapejalons;
    }
}