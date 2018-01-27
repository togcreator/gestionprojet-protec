<?php

namespace ProjectBundle\Entity\Agenda;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgendaParamType
 *
 * @ORM\Table(name="agenda_agenda_param_type")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Agenda\AgendaParamTypeRepository")
 */
class AgendaParamType
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
     * @ORM\Column(name="ouvert", type="integer")
     */
    private $ouvert;

    /**
     * @var int
     *
     * @ORM\Column(name="prive", type="integer")
     */
    private $prive;

    /**
     * @var string
     *
     * @ORM\Column(name="lib0", type="string", length=255)
     */
    private $lib0;

    /**
     * @var string
     *
     * @ORM\Column(name="lib1", type="string", length=255)
     */
    private $lib1;

    /**
     * @var string
     *
     * @ORM\Column(name="lib2", type="string", length=255)
     */
    private $lib2;

    /**
     * @var string
     *
     * @ORM\Column(name="lib3", type="string", length=255)
     */
    private $lib3;

    /**
     * @var string
     *
     * @ORM\Column(name="lib4", type="string", length=255)
     */
    private $lib4;

    /**
     * @var string
     *
     * @ORM\Column(name="lib5", type="string", length=255)
     */
    private $lib5;

    /**
     * @var string
     *
     * @ORM\Column(name="lib6", type="string", length=255)
     */
    private $lib6;

    /**
     * @var string
     *
     * @ORM\Column(name="lib7", type="string", length=255)
     */
    private $lib7;

    /**
     * @var string
     *
     * @ORM\Column(name="lib8", type="string", length=255)
     */
    private $lib8;

    /**
     * @var string
     *
     * @ORM\Column(name="lib9", type="string", length=255)
     */
    private $lib9;

    /**
     * @var string
     *
     * @ORM\Column(name="libcourt", type="string", length=255)
     */
    private $libcourt;

    /**
     * @var string
     *
     * @ORM\Column(name="_table", type="string", length=255)
     */
    private $table;

    /**
     * @var string
     *
     * @ORM\Column(name="typetable", type="string", length=255)
     */
    private $typetable;

    /**
     * @var bool
     *
     * @ORM\Column(name="valide", type="boolean")
     */
    private $valide;

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
     * Set ouvert
     *
     * @param integer $ouvert
     *
     * @return AgendaParamType
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
     * Set prive
     *
     * @param integer $prive
     *
     * @return AgendaParamType
     */
    public function setPrive($prive)
    {
        $this->prive = $prive;

        return $this;
    }

    /**
     * Get prive
     *
     * @return int
     */
    public function getPrive()
    {
        return $this->prive;
    }

    /**
     * Set lib0
     *
     * @param string $lib0
     *
     * @return AgendaParamType
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
     * @return AgendaParamType
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
     * @return AgendaParamType
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
     * @return AgendaParamType
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
     * @return AgendaParamType
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
     * @return AgendaParamType
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
     * @return AgendaParamType
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
     * @return AgendaParamType
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
     * @return AgendaParamType
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
     * @return AgendaParamType
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
     * Set libcourt
     *
     * @param string $libcourt
     *
     * @return AgendaParamType
     */
    public function setLibcourt($libcourt)
    {
        $this->libcourt = $libcourt;

        return $this;
    }

    /**
     * Get libcourt
     *
     * @return string
     */
    public function getLibcourt()
    {
        return $this->libcourt;
    }

    /**
     * Set table
     *
     * @param string $table
     *
     * @return AgendaParamType
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Get table
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set typetable
     *
     * @param string $typetable
     *
     * @return AgendaParamType
     */
    public function setTypetable($typetable)
    {
        $this->typetable = $typetable;

        return $this;
    }

    /**
     * Get typetable
     *
     * @return string
     */
    public function getTypetable()
    {
        return $this->typetable;
    }

    /**
     * Set valide
     *
     * @param boolean $valide
     *
     * @return AgendaParamType
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return bool
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return AgendaParamType
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

