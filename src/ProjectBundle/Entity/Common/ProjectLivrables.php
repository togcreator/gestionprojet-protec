<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectLivrables
 *
 * @ORM\Table(name="common_project_livrables")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectLivrablesRepository")
 */
class ProjectLivrables
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
     * @ORM\Column(name="idProjetVersion", type="integer")
     */
    private $idProjetVersion;

    /**
     * @var int
     *
     * @ORM\Column(name="idEtape", type="integer")
     */
    private $idEtape;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="text")
     */
    private $objet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateprevue", type="datetime")
     */
    private $dateprevue;

    /**
     * @var int
     *
     * @ORM\Column(name="idLeader", type="integer")
     */
    private $idLeader;

    /**
     * @var int
     *
     * @ORM\Column(name="version", type="integer")
     */
    private $version;


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
     * @return ProjectLivrables
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
     * @return ProjectLivrables
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
     * Set titre
     *
     * @param string $titre
     *
     * @return ProjectLivrables
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
     * @param string $objet
     *
     * @return ProjectLivrables
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
     * Set dateprevue
     *
     * @param \DateTime $dateprevue
     *
     * @return ProjectLivrables
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
     * Set idLeader
     *
     * @param integer $idLeader
     *
     * @return ProjectLivrables
     */
    public function setIdLeader($idLeader)
    {
        $this->idLeader = $idLeader;

        return $this;
    }

    /**
     * Get idLeader
     *
     * @return int
     */
    public function getIdLeader()
    {
        return $this->idLeader;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return ProjectLivrables
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
}

