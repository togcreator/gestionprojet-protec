<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;
use ProjectBundle\Entity\Common\ProjectEtape;

/**
 * ProjectDocs
 *
 * @ORM\Table(name="projets_docs")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectDocsRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class ProjectDocs
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=20)
     */
    private $code = '';

    /**
     * @var int
     *
     * @ORM\Column(name="idProjet", type="integer", length=11)
     */
    private $idProjet;

    /**
     * @var object
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumn(name="idProjet", referencedColumnName="id")
     */
    private $project;

    /**
     * @var int
     *
     * @ORM\Column(name="idOperation", type="integer", length=11)
     */
    private $idOperation;

    /**
     * @var object
     * @ORM\ManyToOne(targetEntity="ProjectEtapesOperations")
     * @ORM\JoinColumn(name="idOperation", referencedColumnName="id", nullable=true)
     */
    private $operation;

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
     * @var int
     *
     * @ORM\Column(name="idTypedoc", type="integer", length=11)
     */
    private $idTypedoc = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="origine", type="string", length=20)
     */
    private $origine = '';

    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer", length=11)
     */
    private $idUser;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="\UsersBundle\Entity\UserClient")
     * @ORM\JoinColumn(name="idUser", referencedColumnName="id", nullable=true)
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReception", type="date")
     */
    private $dateReception;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=80)
     */
    private $designation = '';

    /**
     * @var string
     *
     * @ORM\Column(name="nomdoc", type="string", length=255)
     */
    private $nomdoc = '';

    /**
     * @var string
     *
     * @ORM\Column(name="referenceExterne", type="string", length=50)
     */
    private $referenceExterne = '';

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=40)
     */
    private $reference = '';

    /**
     * @var string
     *
     * @ORM\Column(name="nomRedacteurExterne", type="string", length=50)
     */
    private $nomRedacteurExterne = '';

    /**
     * @var int
     *
     * @ORM\Column(name="idBiblio", type="integer", length=11)
     */
    private $idBiblio = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="version", type="integer", length=11)
     */
    private $version = 0;


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
     * Set code
     *
     * @param string $code
     *
     * @return ProjectDocs
     */
    public function setCode($code)
    {
        $this->code = $code ? $code : $this->code;

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
     * Set idProjet
     *
     * @param integer $idProjet
     *
     * @return ProjectDocs
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
     * @param integer $project
     *
     * @return ProjectDocs
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return int
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set idEtape
     *
     * @param integer $idEtape
     *
     * @return ProjectDocs
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
     * Set idOperation
     *
     * @param integer $idOperation
     *
     * @return ProjectDocs
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
     * Set idIssue
     *
     * @param integer $idIssue
     *
     * @return ProjectDocs
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
     * Set idTypedoc
     *
     * @param integer $idTypedoc
     *
     * @return ProjectDocs
     */
    public function setIdTypedoc($idTypedoc)
    {
        $this->idTypedoc = $idTypedoc ? $idTypedoc : $this->idTypedoc;

        return $this;
    }

    /**
     * Get idTypedoc
     *
     * @return int
     */
    public function getIdTypedoc()
    {
        return $this->idTypedoc;
    }

    /**
     * Set origine
     *
     * @param string $origine
     *
     * @return ProjectDocs
     */
    public function setOrigine($origine)
    {
        $this->origine = $origine ? $origine : $this->origine;

        return $this;
    }

    /**
     * Get origine
     *
     * @return string
     */
    public function getOrigine()
    {
        return $this->origine;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return ProjectDocs
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
     * Set designation
     *
     * @param string $designation
     *
     * @return ProjectDocs
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation ? $designation : $this->designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set nomdoc
     *
     * @param string $nomdoc
     *
     * @return ProjectDocs
     */
    public function setNomdoc($nomdoc)
    {
        $this->nomdoc = $nomdoc ? $nomdoc : $this->nomdoc;

        return $this;
    }

    /**
     * Get nomdoc
     *
     * @return string
     */
    public function getNomdoc()
    {
        return $this->nomdoc;
    }

    /**
     * Set dateReception
     *
     * @param \DateTime $dateReception
     *
     * @return ProjectDocs
     */
    public function setDateReception($dateReception)
    {
        $this->dateReception = $dateReception;

        return $this;
    }

    /**
     * Get dateReception
     *
     * @return \DateTime
     */
    public function getDateReception()
    {
        return $this->dateReception;
    }

    /**
     * Set referenceExterne
     *
     * @param string $referenceExterne
     *
     * @return ProjectDocs
     */
    public function setReferenceExterne($referenceExterne)
    {
        $this->referenceExterne = $referenceExterne ? $referenceExterne : $this->referenceExterne;

        return $this;
    }

    /**
     * Get referenceExterne
     *
     * @return string
     */
    public function getReferenceExterne()
    {
        return $this->referenceExterne;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return ProjectDocs
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
     * Set nomRedacteurExterne
     *
     * @param string $nomRedacteurExterne
     *
     * @return ProjectDocs
     */
    public function setNomRedacteurExterne($nomRedacteurExterne)
    {
        $this->nomRedacteurExterne = $nomRedacteurExterne ? $nomRedacteurExterne : $this->nomRedacteurExterne;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getNomRedacteurExterne()
    {
        return $this->nomRedacteurExterne;
    }

    /**
     * Set idBiblio
     *
     * @param integer $idBiblio
     *
     * @return ProjectDocs
     */
    public function setIdBiblio($idBiblio)
    {
        $this->idBiblio = $idBiblio ? $idBiblio : $this->idBiblio;

        return $this;
    }

    /**
     * Get idBiblio
     *
     * @return int
     */
    public function getIdBiblio()
    {
        return $this->idBiblio;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return ProjectDocs
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

    /**
     * Set etape
     *
     * @param object $etape
     *
     * @return ProjectDocs
     */
    public function setEtape($etape)
    {
        $this->etape = $etape;

        return $this;
    }

    /**
     * Get operation
     *
     * @return int
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * Set operation
     *
     * @param object $operation
     *
     * @return ProjectDocs
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
     * Set user
     *
     * @param object $operation
     *
     * @return ProjectDocs
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }
}

