<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusinessUnit
 *
 * @ORM\Table(name="businessunit")
 * @ORM\Entity(repositoryClass="UsersBundle\Repository\BusinessUnitRepository")
 */
class BusinessUnit
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDBusinessUnit", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NomBusinessUnit", type="string", length=50)
     */
    private $nomBusinessUnit;

    /**
     * @var string
     *
     * @ORM\Column(name="Code", type="string", length=20)
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="HG", type="integer")
     */
    private $hG;

    /**
     * @var string
     *
     * @ORM\Column(name="codeEntites", type="string", length=20)
     */
    private $codeEntites;

    /**
     * @var string
     *
     * @ORM\Column(name="codeChantiers", type="string", length=20)
     */
    private $codeChantiers;


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
     * Set nomBusinessUnit
     *
     * @param string $nomBusinessUnit
     *
     * @return BusinessUnit
     */
    public function setNomBusinessUnit($nomBusinessUnit)
    {
        $this->nomBusinessUnit = $nomBusinessUnit;

        return $this;
    }

    /**
     * Get nomBusinessUnit
     *
     * @return string
     */
    public function getNomBusinessUnit()
    {
        return $this->nomBusinessUnit;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return BusinessUnit
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
     * Set hG
     *
     * @param integer $hG
     *
     * @return BusinessUnit
     */
    public function setHG($hG)
    {
        $this->hG = $hG;

        return $this;
    }

    /**
     * Get hG
     *
     * @return int
     */
    public function getHG()
    {
        return $this->hG;
    }

    /**
     * Set codeEntities
     *
     * @param string $codeEntities
     *
     * @return BusinessUnit
     */
    public function setCodeEntites($codeEntites)
    {
        $this->codeEntites = $codeEntites;

        return $this;
    }

    /**
     * Get codeEntities
     *
     * @return string
     */
    public function getCodeEntites()
    {
        return $this->codeEntites;
    }

    /**
     * Set codeChantiers
     *
     * @param string $codeChantiers
     *
     * @return BusinessUnit
     */
    public function setCodeChantiers($codeChantiers)
    {
        $this->codeChantiers = $codeChantiers;

        return $this;
    }

    /**
     * Get codeChantiers
     *
     * @return string
     */
    public function getCodeChantiers()
    {
        return $this->codeChantiers;
    }
}

