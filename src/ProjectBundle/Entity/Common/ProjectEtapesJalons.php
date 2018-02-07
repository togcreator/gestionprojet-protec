<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectEtapesJalons
 *
 * @ORM\Table(name="projet_etapes_jalons")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectEtapesJalonsRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class ProjectEtapesJalons
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
     * @ORM\ManyToOne(targetEntity="Project", fetch="EAGER")
     * @ORM\JoinColumn(name="idProjetversion", referencedColumnName="id")
     */
    private $project;

    /**
     * @var int
     *
     * @ORM\Column(name="idEtape", type="integer", length=11)
     */
    private $idEtape;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="ProjectEtape", fetch="EAGER")
     * @ORM\JoinColumn(name="idEtape", referencedColumnName="id", nullable=true)
     */
    private $etape;

    /**
     * @var int
     *
     * @ORM\Column(name="idAgenda", type="integer", length=11)
     */
    private $idAgenda;

    /**
     * @var int
     *
     * @ORM\Column(name="idTypeJalon", type="integer", length=11)
     */
    private $idTypeJalon;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="\ProjectBundle\Entity\Back\Jalon", fetch="EAGER")
     * @ORM\JoinColumn(name="idTypeJalon", referencedColumnName="id")
     */
    private $typejalon;

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
     * @ORM\Column(name="dateprevue", type="date")
     */
    private $dateprevue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datereelle", type="date")
     */
    private $datereelle;

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
     * @ORM\Column(name="idResultat", type="integer", length=11)
     */
    private $idResultat;

    /**
     * @ORM\ManyToOne(targetEntity="\ProjectBundle\Entity\Back\Resultat", fetch="EAGER")
     * @ORM\JoinColumn(name="idResultat", referencedColumnName="id", nullable=true)
     */
    private $resultat;

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
     * @return ProjectEtapesJalons
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
     * Set project
     *
     * @param integer $project
     *
     * @return ProjectEtapesJalons
     */
    public function setProject(Project $project)
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
     * @return ProjectEtapesJalons
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
     * Set idAgenda
     *
     * @param integer $idAgenda
     *
     * @return ProjectEtapesJalons
     */
    public function setIdAgenda($idAgenda)
    {
        $this->idAgenda = $idAgenda;

        return $this;
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
     * Get idAgenda
     *
     * @return int
     */
    public function getIdAgenda()
    {
        return $this->idAgenda;
    }

    /**
     * Set idTypeJalon
     *
     * @param integer $idTypeJalon
     *
     * @return ProjectEtapesJalons
     */
    public function setIdTypeJalon($idTypeJalon)
    {
        $this->idTypeJalon = $idTypeJalon;

        return $this;
    }

    /**
     * Get idTypeJalon
     *
     * @return int
     */
    public function getIdTypeJalon()
    {
        return $this->idTypeJalon;
    }

    /**
     * Set typejalon
     *
     * @param integer $typejalon
     *
     * @return ProjectEtapesJalons
     */
    public function setTypejalon($typejalon)
    {
        $this->typejalon = $typejalon;

        return $this;
    }

    /**
     * Get typejalon
     *
     * @return int
     */
    public function getTypejalon()
    {
        return $this->typejalon;
    }

    /**
     * Set object
     *
     * @param string $object
     *
     * @return ProjectEtapesJalons
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
     * @return ProjectEtapesJalons
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
     * Set dateprevue
     *
     * @param \DateTime $dateprevue
     *
     * @return ProjectEtapesJalons
     */
    public function setDateprevue($dateprevue)
    {
        $this->dateprevue = $dateprevue;

        return $this;
    }

    /**
     * Get dateprevue
     *
     * @return \DateTime
     */
    public function getDateprevue()
    {
        return $this->dateprevue;
    }

    /**
     * Set datereelle
     *
     * @param \DateTime $datereelle
     *
     * @return ProjectEtapesJalons
     */
    public function setDatereelle($datereelle)
    {
        $this->datereelle = $datereelle;

        return $this;
    }

    /**
     * Get datereelle
     *
     * @return \DateTime
     */
    public function getDatereelle()
    {
        return $this->datereelle;
    }

    /**
     * Set journeesHommesprevues
     *
     * @param float $journeesHommesprevues
     *
     * @return ProjectEtapesJalons
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
     * @return ProjectEtapesJalons
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
     * Set idResultat
     *
     * @param integer $idResultat
     *
     * @return ProjectEtapesJalons
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
     * Set resultat
     *
     * @param integer $resultat
     *
     * @return ProjectEtapesJalons
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * Get resultat
     *
     * @return int
     */
    public function getResultat()
    {
        return $this->resultat;
    }
}

