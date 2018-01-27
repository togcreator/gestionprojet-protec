<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectNotes
 *
 * @ORM\Table(name="projet_notes")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectNotesRepository")
 */
class ProjectNotes
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=20)
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="idProjetVersion", type="integer", length=11)
     */
    private $idProjetVersion;

    /**
     * @var project
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="notes", fetch="EAGER")
     * @ORM\JoinColumn(name="idProjetVersion", referencedColumnName="id")
     */
    private $project;

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
     * @ORM\Column(name="idIssue", type="integer", length=11)
     */
    private $idIssue;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer", length=11)
     */
    private $idUser;

    /**
     * @var users
     * @ORM\ManyToOne(targetEntity="\UsersBundle\Entity\UserClient", fetch="EAGER")
     * @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=50)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="text")
     */
    private $objet;

    /**
     * @var date
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="version", type="integer", length=11)
     */
    private $version = 1;

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
     * @return ProjectNotes
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
     * Set idProjetVersion
     *
     * @param integer $idProjetVersion
     *
     * @return ProjectNotes
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
     * Set idEtape
     *
     * @param integer $idEtape
     *
     * @return ProjectNotes
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
     * @return ProjectNotes
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
     * @return ProjectNotes
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
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return ProjectNotes
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
     * Set titre
     *
     * @param string $titre
     *
     * @return ProjectNotes
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
     * Set objet
     *
     * @param text $objet
     *
     * @return ProjectNotes
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
     * Set date
     *
     * @param date $date
     *
     * @return ProjectNotes
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return ProjectNotes
     */
    public function setVersion($version)
    {
        $this->version = $version ? $version : $this->version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set user
     *
     * @param users $user
     *
     * @return ProjectNotes
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set project
     *
     * @param project $project
     *
     * @return ProjectNotes
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     * @ORM\postLoad
     * @return project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set etape
     *
     * @param Note $etape
     *
     * @return ProjectNotes
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
     * Set etape
     *
     * @param Note $operation
     *
     * @return ProjectNotes
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;

        return $this;
    }

    /**
     * Get etape
     *
     * @return object
     */
    public function getOperation()
    {
        return $this->operation;
    }
}

