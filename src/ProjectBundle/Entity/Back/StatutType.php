<?php

namespace ProjectBundle\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatutType
 *
 * @ORM\Table(name="param_projet_statut_type")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Back\statutTypeRepository")
 * @ProjectBundle\Annotation\Label\LabelClass
 */
class StatutType
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
     * @var string
     */
    private $label = '';

    /**
     * @var int
     *
     * @ORM\Column(name="version", type="integer", length=80)
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
     * @return StatutType
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
     * Set lib0
     *
     * @param string $lib0
     *
     * @return StatutType
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
     * @return StatutType
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
     * @return StatutType
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
     * @return StatutType
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
     * @return StatutType
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
     * @return StatutType
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
     * @return StatutType
     */
    public function setLib6($lib6)
    {
        $this->lib6 = $lib6 ? $lib6 : $this->lib6;

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
     * @return StatutType
     */
    public function setLib7($lib7)
    {
        $this->lib7 = $lib7 ? $lib7 : $this->lib7;

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
     * @return StatutType
     */
    public function setLib8($lib8)
    {
        $this->lib8 = $lib8 ? $lib8 : $this->lib8;

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
     * @return StatutType
     */
    public function setLib9($lib9)
    {
        $this->lib9 = $lib9 ? $lib9 : $this->lib9;

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
     * Set label
     *
     * @param string $label
     *
     * @return StatutType
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
     * Set version
     *
     * @param integer $version
     *
     * @return StatutType
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

