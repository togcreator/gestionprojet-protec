<?php

namespace CrmBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmDocsEnvoyes
 *
 * @ORM\Table(name="crm_docs_envoyes")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\Common\CrmDocsEnvoyesRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class CrmDocsEnvoyes
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
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="idCrm", type="integer", length=11, nullable=true)
     */
    private $idCrm;

    /**
     * @var object
     */
    private $crm;

    /**
     * @var int
     *
     * @ORM\Column(name="idOperation", type="integer", length=11, nullable=true)
     */
    private $idOperation;

    /**
     * @var object
     */
    private $operation;

    /**
     * @var int
     *
     * @ORM\Column(name="idTypedoc", type="integer", length=11, nullable=true)
     */
    private $idTypedoc;

    /**
     * @var string
     *
     * @ORM\Column(name="origine", type="string", length=20, nullable=true)
     */
    private $origine;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer", length=11)
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=80, nullable=true)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="nomdoc", type="string", length=255, nullable=true)
     */
    private $nomdoc = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnvoi", type="date")
     */
    private $dateEnvoi;

    /**
     * @var string
     *
     * @ORM\Column(name="referenceInterne", type="string", length=50, nullable=true)
     */
    private $referenceInterne;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=40)
     */
    private $reference;

    /**
     * @var int
     *
     * @ORM\Column(name="idBiblio", type="integer", length=11, nullable=true)
     */
    private $idBiblio;

    /**
     * @var int
     *
     * @ORM\Column(name="idMail", type="integer", length=11, nullable=true)
     */
    private $idMail;

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
     * @return CrmDocsEnvoyes
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
     * Set idCrm
     *
     * @param integer $idCrm
     *
     * @return CrmDocsEnvoyes
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
     * @return CrmDocsEnvoyes
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
     * Set idOperation
     *
     * @param integer $idOperation
     *
     * @return CrmDocsEnvoyes
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
     * @return CrmDocsEnvoyes
     */
    public function setIdTypedoc($idTypedoc)
    {
        $this->idTypedoc = $idTypedoc;

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
     * @return CrmDocsEnvoyes
     */
    public function setOrigine($origine)
    {
        $this->origine = $origine;

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
     * @return CrmDocsEnvoyes
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
     * @return CrmDocsEnvoyes
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

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
     * @return CrmDocsEnvoyes
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
     * Set dateEnvoi
     *
     * @param \DateTime $dateEnvoi
     *
     * @return CrmDocsEnvoyes
     */
    public function setDateEnvoi($dateEnvoi)
    {
        $this->dateEnvoi = $dateEnvoi;

        return $this;
    }

    /**
     * Get dateEnvoi
     *
     * @return \DateTime
     */
    public function getDateEnvoi()
    {
        return $this->dateEnvoi;
    }

    /**
     * Set referenceInterne
     *
     * @param string $referenceInterne
     *
     * @return CrmDocsEnvoyes
     */
    public function setReferenceInterne($referenceInterne)
    {
        $this->referenceInterne = $referenceInterne;

        return $this;
    }

    /**
     * Get referenceInterne
     *
     * @return string
     */
    public function getReferenceInterne()
    {
        return $this->referenceInterne;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return CrmDocsEnvoyes
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
     * Set idBiblio
     *
     * @param integer $idBiblio
     *
     * @return CrmDocsEnvoyes
     */
    public function setIdBiblio($idBiblio)
    {
        $this->idBiblio = $idBiblio;

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
     * @return CrmDocsEnvoyes
     */
    public function setIdMail($idMail)
    {
        $this->idMail = $idMail;

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
     * @return CrmDocsEnvoyes
     */
    public function setVersion($version)
    {
        $this->version = $version ? $version: $this->version;

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

