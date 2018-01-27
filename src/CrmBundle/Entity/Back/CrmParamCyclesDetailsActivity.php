<?php

namespace CrmBundle\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * CRM
 *
 * @ORM\Table(name="param_crm_cycles_details_activites")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\Back\CrmParamCyclesDetailsActivityRepository")
 * @ProjectBundle\Annotation\Label\LabelClass
 */
class CrmParamCyclesDetailsActivity
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
     * @ORM\Column(name="idCycle", type="integer", length=11)
     */
    private $idCycle;

    /**
     * @var int
     *
     * @ORM\Column(name="idCycledetail", type="integer", length=11)
     */
    private $idCycledetail;

    /**
     * @var int
     *
     * @ORM\Column(name="idActivite", type="integer", length=11)
     */
    private $idActivite;

    /**
     * @var int
     *
     * @ORM\Column(name="ouvert", type="integer", length=11)
     */
    private $ouvert;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="lib0", type="string", length=80)
     */
    private $lib0;

    /**
     * @var string
     *
     * @ORM\Column(name="lib1", type="string", length=80)
     */
    private $lib1;

    /**
     * @var string
     *
     * @ORM\Column(name="lib2", type="string", length=80)
     */
    private $lib2;

    /**
     * @var string
     *
     * @ORM\Column(name="lib3", type="string", length=80)
     */
    private $lib3;

    /**
     * @var string
     *
     * @ORM\Column(name="lib4", type="string", length=80)
     */
    private $lib4;

    /**
     * @var string
     *
     * @ORM\Column(name="lib5", type="string", length=80)
     */
    private $lib5;

    /**
     * @var string
     *
     * @ORM\Column(name="lib6", type="string", length=80)
     */
    private $lib6;

    /**
     * @var string
     *
     * @ORM\Column(name="lib7", type="string", length=80)
     */
    private $lib7;

    /**
     * @var string
     *
     * @ORM\Column(name="lib8", type="string", length=80)
     */
    private $lib8;

    /**
     * @var string
     *
     * @ORM\Column(name="lib9", type="string", length=80)
     */
    private $lib9;

    /**
     * @var int
     *
     * @ORM\Column(name="idPriorite", type="integer", length=11)
     */
    private $idPriorite;

    /**
     * @var int
     *
     * @ORM\Column(name="delaiRealisation", type="integer", length=11)
     */
    private $delaiRealisation;

    /**
     * @var int
     *
     * @ORM\Column(name="reminderNBJJ", type="integer", length=11)
     */
    private $reminderNBJJ;

    /**
     * @var int
     *
     * @ORM\Column(name="reminderHH", type="integer", length=11)
     */
    private $reminderHH;

    /**
     * @var int
     *
     * @ORM\Column(name="reminderMM", type="integer", length=11)
     */
    private $reminderMM;

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
     * @return Jalon
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
     * @return Jalon
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
     * @return Jalon
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
     * @return Jalon
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
     * @return Jalon
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
     * @return Jalon
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
     * @return Jalon
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
     * @return Jalon
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
     * @return Jalon
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
     * @return Jalon
     */
    public function setLib9($lib9)
    {
        $this->lib9 = $lib9;

        return $this;
    }

    /**
     * Get lib9
     *
     * @return int
     */
    public function getLib9()
    {
        return $this->lib9;
    }

    /**
     * Set idCycle
     *
     * @param integer $idCycle
     *
     * @return Cycles
     */
    public function setIdCycle($idCycle)
    {
        $this->idCycle = $idCycle;

        return $this;
    }

    /**
     * Get idCycle
     *
     * @return int
     */
    public function getIdCycle()
    {
        return $this->idCycle;
    }

    /**
     * Set idCycledetail
     *
     * @param integer $idCycledetail
     *
     * @return Cycles
     */
    public function setIdCycledetail($idCycledetail)
    {
        $this->idCycledetail = $idCycledetail;

        return $this;
    }

    /**
     * Get idActivite
     *
     * @return int
     */
    public function getIdCycledetail()
    {
        return $this->idCycledetail;
    }

    /**
     * Set idActivite
     *
     * @param integer $idActivite
     *
     * @return Cycles
     */
    public function setIdActivite($idActivite)
    {
        $this->idActivite = $idActivite;

        return $this;
    }

    /**
     * Get idActivite
     *
     * @return int
     */
    public function getIdActivite()
    {
        return $this->idActivite;
    }

    /**
     * Set idPriorite
     *
     * @param integer $idPriorite
     *
     * @return Cycles
     */
    public function setIdPriorite($idPriorite)
    {
        $this->idPriorite = $idPriorite;

        return $this;
    }

    /**
     * Get idPriorite
     *
     * @return int
     */
    public function getIdPriorite()
    {
        return $this->idPriorite;
    }

    /**
     * Set delaiRealisation
     *
     * @param integer $delaiRealisation
     *
     * @return Cycles
     */
    public function setDelaiRealisation($delaiRealisation)
    {
        $this->delaiRealisation = $delaiRealisation;

        return $this;
    }

    /**
     * Get delaiRealisation
     *
     * @return int
     */
    public function getDelaiRealisation()
    {
        return $this->delaiRealisation;
    }

    /**
     * Set reminderNBJJ
     *
     * @param integer $reminderNBJJ
     *
     * @return Cycles
     */
    public function setReminderNBJJ($reminderNBJJ)
    {
        $this->reminderNBJJ = $reminderNBJJ;

        return $this;
    }

    /**
     * Get reminderNBJJ
     *
     * @return int
     */
    public function getReminderNBJJ()
    {
        return $this->reminderNBJJ;
    }

    /**
     * Set reminderHH
     *
     * @param integer $reminderHH
     *
     * @return Cycles
     */
    public function setReminderHH($reminderHH)
    {
        $this->reminderHH = $reminderHH;

        return $this;
    }

    /**
     * Get reminderHH
     *
     * @return int
     */
    public function getReminderHH()
    {
        return $this->reminderHH;
    }

    /**
     * Set reminderMM
     *
     * @param integer $reminderMM
     *
     * @return Cycles
     */
    public function setReminderMM($reminderMM)
    {
        $this->reminderMM = $reminderMM;

        return $this;
    }

    /**
     * Get reminderMM
     *
     * @return int
     */
    public function getReminderMM()
    {
        return $this->reminderMM;
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

