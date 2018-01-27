<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectEtapesOperationsIssuesOrganisation
 *
 * @ORM\Table(name="projet_etapes_operations_issues_organisation")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectEtapesOperationsIssuesOrganisationRepository")
 */
class ProjectEtapesOperationsIssuesOrganisation
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
     * @ORM\Column(name="idIssue", type="integer", length=11)
     */
    private $idIssue;

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
     * @ORM\Column(name="Version", type="integer", length=11)
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
     * @return ProjectEtapesOperationsIssuesOrganisation
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
     * Set idIssue
     *
     * @param integer $idIssue
     *
     * @return ProjectEtapesOperationsIssuesOrganisation
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
     * Set commentaires
     *
     * @param string $commentaires
     *
     * @return ProjectEtapesOperationsIssuesOrganisation
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
     * @return ProjectEtapesOperationsIssuesOrganisation
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
     * @return ProjectEtapesOperationsIssuesOrganisation
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

