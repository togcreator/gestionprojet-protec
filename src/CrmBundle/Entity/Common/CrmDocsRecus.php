<?php

namespace CrmBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmDocsRecus
 *
 * @ORM\Table(name="crm_docs_recus")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\Common\CrmDocsRecusRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class CrmDocsRecus
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
     * @ORM\Column(name="idCrm", type="integer", length=11)
     */
    private $idCrm;

    /**
     * @var object
     */
    private $crm;

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
     * @var \DateTime
     *
     * @ORM\Column(name="dateReception", type="date")
     */
    private $dateReception;

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
     * @ORM\Column(name="idMail", type="integer", length=11)
     */
    private $idMail = 0;

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
     * @return CrmDocsRecus
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
     * Set idCrm
     *
     * @param integer $idCrm
     *
     * @return CrmDocsRecus
     */
    public function setIdCrm($idCrm)
    {
        $this->idCrm = $idCrm;

        return $this;
    }

    /**
     * Get idCrm
     *
     * @return int
     */
    public function getIdCrm()
    {
        return $this->idCrm;
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
     * Set operation
     *
     * @param integer $operation
     *
     * @return CrmEtapesOperations
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
     * Set idEtape
     *
     * @param integer $idEtape
     *
     * @return CrmDocsRecus
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
     * @return CrmDocsRecus
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
     * Set idTypedoc
     *
     * @param integer $idTypedoc
     *
     * @return CrmDocsRecus
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
     * @return CrmDocsRecus
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
     * @return CrmDocsRecus
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
     * @return CrmDocsRecus
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
     * @return CrmDocsRecus
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
     * @return CrmDocsRecus
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
     * @return CrmDocsRecus
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
     * @return CrmDocsRecus
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
     * @return CrmDocsRecus
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
     * @return CrmDocsRecus
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
     * Set idMail
     *
     * @param integer $idMail
     *
     * @return CrmDocsRecus
     */
    public function setIdMail($idMail)
    {
        $this->idMail = $idMail ? $idMail : $this->idMail;

        return $this;
    }

    /**
     * Get idMail
     *
     * @return int
     */
    public function getIdMail()
    {
        return $this->idMail;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return CrmDocsRecus
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

