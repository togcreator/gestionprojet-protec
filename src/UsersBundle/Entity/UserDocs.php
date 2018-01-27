<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserDocs
 *
 * @ORM\Table(name="user_docs")
 * @ORM\Entity(repositoryClass="UsersBundle\Repository\UserDocsRepository")
 */
class UserDocs
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
     * @ORM\Column(name="IDUser", type="integer")
     */
    private $iDUser;

    /**
     * @var int
     *
     * @ORM\Column(name="IDType", type="integer")
     */
    private $iDType;

    /**
     * @var string
     *
     * @ORM\Column(name="origine", type="string", length=20)
     */
    private $origine;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser4origine", type="integer")
     */
    private $idUser4origine;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=80)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=20)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="nomdoc", type="string", length=255)
     */
    private $nomdoc = '';

    /**
     * @var int
     *
     * @ORM\Column(name="idBiblio", type="integer")
     */
    private $idBiblio;

    /**
     * @var int
     *
     * @ORM\Column(name="version", type="integer")
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
     * Set iDUser
     *
     * @param integer $iDUser
     *
     * @return UserDocs
     */
    public function setIDUser($iDUser)
    {
        $this->iDUser = $iDUser;

        return $this;
    }

    /**
     * Get iDUser
     *
     * @return int
     */
    public function getIDUser()
    {
        return $this->iDUser;
    }

    /**
     * Set iDType
     *
     * @param integer $iDType
     *
     * @return UserDocs
     */
    public function setIDType($iDType)
    {
        $this->iDType = $iDType;

        return $this;
    }

    /**
     * Get iDType
     *
     * @return int
     */
    public function getIDType()
    {
        return $this->iDType;
    }

    /**
     * Set origine
     *
     * @param string $origine
     *
     * @return UserDocs
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
     * Set idUser4origine
     *
     * @param integer $idUser4origine
     *
     * @return UserDocs
     */
    public function setIdUser4origine($idUser4origine)
    {
        $this->idUser4origine = $idUser4origine;

        return $this;
    }

    /**
     * Get idUser4origine
     *
     * @return int
     */
    public function getIdUser4origine()
    {
        return $this->idUser4origine;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return UserDocs
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
     * Set designation
     *
     * @param string $designation
     *
     * @return UserDocs
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
     * Set code
     *
     * @param string $code
     *
     * @return UserDocs
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
     * Set nomdoc
     *
     * @param string $nomdoc
     *
     * @return UserDocs
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
     * Set idBiblio
     *
     * @param integer $idBiblio
     *
     * @return UserDocs
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
     * Set version
     *
     * @param integer $version
     *
     * @return UserDocs
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

