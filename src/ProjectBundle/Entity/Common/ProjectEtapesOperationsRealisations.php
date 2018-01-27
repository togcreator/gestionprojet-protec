<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectEtapesOperationsRealisations
 *
 * @ORM\Table(name="projet_etapes_operations_realisations")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectEtapesOperationsRealisationsRepository")
 */
class ProjectEtapesOperationsRealisations
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
     * @ORM\Column(name="idParent", type="integer", length=11)
     */
    private $idParent;

    /**
     * @var int
     *
     * @ORM\Column(name="idOperation", type="integer", length=11)
     */
    private $idOperation;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaires", type="text")
     */
    private $commentaires;

    /**
     * @var int
     *
     * @ORM\Column(name="idTyperelation", type="integer", length=11)
     */
    private $idTyperelation;

    /**
     * @var int
     *
     * @ORM\Column(name="version", type="integer", length=11)
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
     * Set idParent
     *
     * @param integer $idParent
     *
     * @return ProjetEtapesOperationsRealisations
     */
    public function setIdParent($idParent)
    {
        $this->idParent = $idParent;

        return $this;
    }

    /**
     * Get idParent
     *
     * @return int
     */
    public function getIdParent()
    {
        return $this->idParent;
    }

    /**
     * Set idOperation
     *
     * @param integer $idOperation
     *
     * @return ProjetEtapesOperationsRealisations
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
     * Set commentaires
     *
     * @param string $commentaires
     *
     * @return ProjetEtapesOperationsRealisations
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set idTyperelation
     *
     * @param integer $idTyperelation
     *
     * @return ProjetEtapesOperationsRealisations
     */
    public function setIdTyperelation($idTyperelation)
    {
        $this->idTyperelation = $idTyperelation;

        return $this;
    }

    /**
     * Get idTyperelation
     *
     * @return int
     */
    public function getIdTyperelation()
    {
        return $this->idTyperelation;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return ProjetEtapesOperationsRealisations
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

