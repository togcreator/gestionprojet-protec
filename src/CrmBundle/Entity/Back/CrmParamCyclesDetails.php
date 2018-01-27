<?php

namespace CrmBundle\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jalon
 *
 * @ORM\Table(name="param_crm_cycles_details")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\Back\CrmParamCyclesDetailsRepository")
 * @ProjectBundle\Annotation\Label\LabelClass
 */
class CrmParamCyclesDetails
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
     * @ORM\Column(name="ouvert", type="integer", length=11)
     */
    private $ouvert;

    /**
     * @var int
     *
     * @ORM\Column(name="idCycle", type="integer", length=11)
     */
    private $idCycle;

    /* cycle */
    private $cycle;

    /**
     * @var int
     *
     * @ORM\Column(name="idTypecycle", type="integer", length=11)
     */
    private $idTypecycle;

    /* type cycle */
    private $Typecycle;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer", length=11)
     */
    private $ordre = 0;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="lib0", type="string", length=80)
     */
    private $lib0 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib1", type="string", length=80)
     */
    private $lib1 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib2", type="string", length=80)
     */
    private $lib2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib3", type="string", length=80)
     */
    private $lib3 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib4", type="string", length=80)
     */
    private $lib4 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib5", type="string", length=80)
     */
    private $lib5 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib6", type="string", length=80)
     */
    private $lib6 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib7", type="string", length=80)
     */
    private $lib7 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib8", type="string", length=80)
     */
    private $lib8 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib9", type="string", length=80)
     */
    private $lib9 = '';

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
     * Set ouvert
     *
     * @param integer $ouvert
     *
     * @return Jalon
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
     * Set label
     *
     * @param string $label
     *
     * @return Jalon
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set lib0
     *
     * @param string $lib0
     *
     * @return CrmDossier
     */
    public function setLib0($lib0)
    {
        $this->lib0 = $lib0 ? $lib0 : $this->lib0;

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
     * @return CrmDossier
     */
    public function setlib1($lib1)
    {
        $this->lib1 = $lib1 ? $lib1 : $this->lib1;

        return $this;
    }

    /**
     * Get lib1
     *
     * @return string
     */
    public function getlib1()
    {
        return $this->lib1;
    }

    /**
     * Set lib2
     *
     * @param string $lib2
     *
     * @return CrmDossier
     */
    public function setlib2($lib2)
    {
        $this->lib2 = $lib2 ? $lib2 : $this->lib2;

        return $this;
    }

    /**
     * Get lib2
     *
     * @return string
     */
    public function getlib2()
    {
        return $this->lib2;
    }

    /**
     * Set lib3
     *
     * @param string $lib3
     *
     * @return CrmDossier
     */
    public function setlib3($lib3)
    {
        $this->lib3 = $lib3 ? $lib3 : $this->lib3;

        return $this;
    }

    /**
     * Get lib3
     *
     * @return string
     */
    public function getlib3()
    {
        return $this->lib3;
    }

    /**
     * Set lib4
     *
     * @param string $lib4
     *
     * @return CrmDossier
     */
    public function setlib4($lib4)
    {
        $this->lib4 = $lib4 ? $lib4 : $this->lib4;

        return $this;
    }

    /**
     * Get lib4
     *
     * @return string
     */
    public function getlib4()
    {
        return $this->lib4;
    }

    /**
     * Set lib5
     *
     * @param string $lib5
     *
     * @return CrmDossier
     */
    public function setlib5($lib5)
    {
        $this->lib5 = $lib5 ? $lib5 : $this->lib5;

        return $this;
    }

    /**
     * Get lib5
     *
     * @return string
     */
    public function getlib5()
    {
        return $this->lib5;
    }

    /**
     * Set lib6
     *
     * @param string $lib6
     *
     * @return CrmDossier
     */
    public function setlib6($lib6)
    {
        $this->lib6 = $lib6 ? $lib6 : $this->lib6;

        return $this;
    }

    /**
     * Get lib6
     *
     * @return string
     */
    public function getlib6()
    {
        return $this->lib6;
    }

    /**
     * Set lib7
     *
     * @param string $lib7
     *
     * @return CrmDossier
     */
    public function setlib7($lib7)
    {
        $this->lib7 = $lib7 ? $lib7 : $this->lib7;

        return $this;
    }

    /**
     * Get lib7
     *
     * @return string
     */
    public function getlib7()
    {
        return $this->lib7;
    }

    /**
     * Set lib8
     *
     * @param string $lib8
     *
     * @return CrmDossier
     */
    public function setlib8($lib8)
    {
        $this->lib8 = $lib8 ? $lib8 : $this->lib8;

        return $this;
    }

    /**
     * Get lib8
     *
     * @return string
     */
    public function getlib8()
    {
        return $this->lib8;
    }

    /**
     * Set lib9
     *
     * @param string $lib9
     *
     * @return CrmDossier
     */
    public function setlib9($lib9)
    {
        $this->lib9 = $lib9 ? $lib9 : $this->lib9;

        return $this;
    }

    /**
     * Get lib9
     *
     * @return string
     */
    public function getlib9()
    {
        return $this->lib9;
    }

    /**
     * Set idCycle
     *
     * @param integer $idCycle
     *
     * @return Cycle
     */
    public function setIdCycle($idCycle)
    {
        $this->idCycle = $idCycle;

        return $this;
    }

    /**
     * Get version
     *
     * @return int
     */
    public function getIdCycle()
    {
        return $this->idCycle;
    }

    /**
     * Set cycle
     *
     * @param integer $cycle
     *
     * @return Cycle
     */
    public function setCycle($cycle)
    {
        $this->cycle = $cycle;

        return $this;
    }

    /**
     * Get version
     *
     * @return object
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * Set idTypecycle
     *
     * @param integer $idTypecycle
     *
     * @return Cycle
     */
    public function setIdTypecycle($idTypecycle)
    {
        $this->idTypecycle = $idTypecycle;

        return $this;
    }

    /**
     * Get idTypecycle
     *
     * @return int
     */
    public function getIdTypecycle()
    {
        return $this->idTypecycle;
    }

    /**
     * Set Typecycle
     *
     * @param integer $Typecycle
     *
     * @return Cycle
     */
    public function setTypecycle($Typecycle)
    {
        $this->Typecycle = $Typecycle;

        return $this;
    }

    /**
     * Get Typecycle
     *
     * @return int
     */
    public function getTypecycle()
    {
        return $this->Typecycle;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return Jalon
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre ? $ordre : $this->ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return int
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return Jalon
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

