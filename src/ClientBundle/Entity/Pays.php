<?php

namespace ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity(repositoryClass="ClientBundle\Repository\PaysRepository")
 */
class Pays
{
    /**
     * @var string
     *
     * @ORM\Column(name="codePays", type="string", length=10)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codePays;

    /**
     * @var string
     *
     * @ORM\Column(name="lib0", type="string", length=100)
     */
    private $lib0;

    /**
     * @var string
     *
     * @ORM\Column(name="lib1", type="string", length=100)
     */
    private $lib1;

    /**
     * @var string
     *
     * @ORM\Column(name="lib2", type="string", length=100)
     */
    private $lib2;

    /**
     * @var string
     *
     * @ORM\Column(name="lib3", type="string", length=100)
     */
    private $lib3;

    /**
     * @var string
     *
     * @ORM\Column(name="lib4", type="string", length=100)
     */
    private $lib4;

    /**
     * @var string
     *
     * @ORM\Column(name="lib5", type="string", length=100)
     */
    private $lib5;

    /**
     * @var string
     *
     * @ORM\Column(name="lib6", type="string", length=100)
     */
    private $lib6;

    /**
     * @var string
     *
     * @ORM\Column(name="lib7", type="string", length=100)
     */
    private $lib7;

    /**
     * @var string
     *
     * @ORM\Column(name="lib8", type="string", length=100)
     */
    private $lib8;

    /**
     * @var string
     *
     * @ORM\Column(name="lib9", type="string", length=100)
     */
    private $lib9;

    /**
     * @var string
     *
     * @ORM\Column(name="petiteCarte", type="string", length=255)
     */
    private $petiteCarte;

    /**
     * @var string
     *
     * @ORM\Column(name="grandeCarte", type="string", length=100)
     */
    private $grandeCarte;

    /**
     * @var string
     *
     * @ORM\Column(name="petitDrapeau", type="string", length=100)
     */
    private $petitDrapeau;

    /**
     * @var string
     *
     * @ORM\Column(name="grandDrapeau", type="string", length=100)
     */
    private $grandDrapeau;

    /**
     * @var int
     *
     * @ORM\Column(name="ouvert", type="integer")
     */
    private $ouvert;

    /**
     * @var int
     *
     * @ORM\Column(name="delai", type="integer")
     */
    private $delai;

    /**
     * @var int
     *
     * @ORM\Column(name="cpOk", type="integer")
     */
    private $cpOk;

    /**
     * @var int
     *
     * @ORM\Column(name="adrOk", type="integer")
     */
    private $adrOk;

    /**
     * @var int
     *
     * @ORM\Column(name="telOk", type="integer")
     */
    private $telOk;


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
     * Set codePays
     *
     * @param string $codePays
     *
     * @return Pays
     */
    public function setCodePays($codePays)
    {
        $this->codePays = $codePays;

        return $this;
    }

    /**
     * Get codePays
     *
     * @return string
     */
    public function getCodePays()
    {
        return $this->codePays;
    }

    /**
     * Set lib0
     *
     * @param string $lib0
     *
     * @return Pays
     */
    public function setLib0($lib0)
    {
        $this->lib0 = $lib0;

        return $this;
    }

    /**
     * Get lib0
     *
     * @return string
     */
    public function getLib0()
    {
        return $this->lib0;
    }

    /**
     * Set lib1
     *
     * @param string $lib1
     *
     * @return Pays
     */
    public function setLib1($lib1)
    {
        $this->lib1 = $lib1;

        return $this;
    }

    /**
     * Get lib1
     *
     * @return string
     */
    public function getLib1()
    {
        return $this->lib1;
    }

    /**
     * Set lib2
     *
     * @param string $lib2
     *
     * @return Pays
     */
    public function setLib2($lib2)
    {
        $this->lib2 = $lib2;

        return $this;
    }

    /**
     * Get lib2
     *
     * @return string
     */
    public function getLib2()
    {
        return $this->lib2;
    }

    /**
     * Set lib3
     *
     * @param string $lib3
     *
     * @return Pays
     */
    public function setLib3($lib3)
    {
        $this->lib3 = $lib3;

        return $this;
    }

    /**
     * Get lib3
     *
     * @return string
     */
    public function getLib3()
    {
        return $this->lib3;
    }

    /**
     * Set lib4
     *
     * @param string $lib4
     *
     * @return Pays
     */
    public function setLib4($lib4)
    {
        $this->lib4 = $lib4;

        return $this;
    }

    /**
     * Get lib4
     *
     * @return string
     */
    public function getLib4()
    {
        return $this->lib4;
    }

    /**
     * Set lib5
     *
     * @param string $lib5
     *
     * @return Pays
     */
    public function setLib5($lib5)
    {
        $this->lib5 = $lib5;

        return $this;
    }

    /**
     * Get lib5
     *
     * @return string
     */
    public function getLib5()
    {
        return $this->lib5;
    }

    /**
     * Set lib6
     *
     * @param string $lib6
     *
     * @return Pays
     */
    public function setLib6($lib6)
    {
        $this->lib6 = $lib6;

        return $this;
    }

    /**
     * Get lib6
     *
     * @return string
     */
    public function getLib6()
    {
        return $this->lib6;
    }

    /**
     * Set lib7
     *
     * @param string $lib7
     *
     * @return Pays
     */
    public function setLib7($lib7)
    {
        $this->lib7 = $lib7;

        return $this;
    }

    /**
     * Get lib7
     *
     * @return string
     */
    public function getLib7()
    {
        return $this->lib7;
    }

    /**
     * Set lib8
     *
     * @param string $lib8
     *
     * @return Pays
     */
    public function setLib8($lib8)
    {
        $this->lib8 = $lib8;

        return $this;
    }

    /**
     * Get lib8
     *
     * @return string
     */
    public function getLib8()
    {
        return $this->lib8;
    }

    /**
     * Set lib9
     *
     * @param string $lib9
     *
     * @return Pays
     */
    public function setLib9($lib9)
    {
        $this->lib9 = $lib9;

        return $this;
    }

    /**
     * Get lib9
     *
     * @return string
     */
    public function getLib9()
    {
        return $this->lib9;
    }

    /**
     * Set petiteCarte
     *
     * @param string $petiteCarte
     *
     * @return Pays
     */
    public function setPetiteCarte($petiteCarte)
    {
        $this->petiteCarte = $petiteCarte;

        return $this;
    }

    /**
     * Get petiteCarte
     *
     * @return string
     */
    public function getPetiteCarte()
    {
        return $this->petiteCarte;
    }

    /**
     * Set grandeCarte
     *
     * @param string $grandeCarte
     *
     * @return Pays
     */
    public function setGrandeCarte($grandeCarte)
    {
        $this->grandeCarte = $grandeCarte;

        return $this;
    }

    /**
     * Get grandeCarte
     *
     * @return string
     */
    public function getGrandeCarte()
    {
        return $this->grandeCarte;
    }

    /**
     * Set petitDrapeau
     *
     * @param string $petitDrapeau
     *
     * @return Pays
     */
    public function setPetitDrapeau($petitDrapeau)
    {
        $this->petitDrapeau = $petitDrapeau;

        return $this;
    }

    /**
     * Get petitDrapeau
     *
     * @return string
     */
    public function getPetitDrapeau()
    {
        return $this->petitDrapeau;
    }

    /**
     * Set grandDrapeau
     *
     * @param string $grandDrapeau
     *
     * @return Pays
     */
    public function setGrandDrapeau($grandDrapeau)
    {
        $this->grandDrapeau = $grandDrapeau;

        return $this;
    }

    /**
     * Get grandDrapeau
     *
     * @return string
     */
    public function getGrandDrapeau()
    {
        return $this->grandDrapeau;
    }

    /**
     * Set ouvert
     *
     * @param integer $ouvert
     *
     * @return Pays
     */
    public function setOuvert($ouvert)
    {
        $this->ouvert = $ouvert;

        return $this;
    }

    /**
     * Get ouvert
     *
     * @return int
     */
    public function getOuvert()
    {
        return $this->ouvert;
    }

    /**
     * Set delai
     *
     * @param integer $delai
     *
     * @return Pays
     */
    public function setDelai($delai)
    {
        $this->delai = $delai;

        return $this;
    }

    /**
     * Get delai
     *
     * @return int
     */
    public function getDelai()
    {
        return $this->delai;
    }

    /**
     * Set cpOk
     *
     * @param integer $cpOk
     *
     * @return Pays
     */
    public function setCpOk($cpOk)
    {
        $this->cpOk = $cpOk;

        return $this;
    }

    /**
     * Get cpOk
     *
     * @return int
     */
    public function getCpOk()
    {
        return $this->cpOk;
    }

    /**
     * Set adrOk
     *
     * @param integer $adrOk
     *
     * @return Pays
     */
    public function setAdrOk($adrOk)
    {
        $this->adrOk = $adrOk;

        return $this;
    }

    /**
     * Get adrOk
     *
     * @return int
     */
    public function getAdrOk()
    {
        return $this->adrOk;
    }

    /**
     * Set telOk
     *
     * @param integer $telOk
     *
     * @return Pays
     */
    public function setTelOk($telOk)
    {
        $this->telOk = $telOk;

        return $this;
    }

    /**
     * Get telOk
     *
     * @return int
     */
    public function getTelOk()
    {
        return $this->telOk;
    }
}

