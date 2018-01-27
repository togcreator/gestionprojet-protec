<?php

namespace ProjectBundle\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * ModeAcces
 *
 * @ORM\Table(name="param_projet_modeacces")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Back\ModeAccesRepository")
 * @ProjectBundle\Annotation\Label\LabelClass
 */
class ModeAcces
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
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="lib0", type="text", length=50)
     */
    private $lib0;

    /**
     * @var string
     *
     * @ORM\Column(name="lib1", type="text", length=50)
     */
    private $lib1;

    /**
     * @var string
     *
     * @ORM\Column(name="lib2", type="text", length=50)
     */
    private $lib2;

    /**
     * @var string
     *
     * @ORM\Column(name="lib3", type="text", length=50)
     */
    private $lib3;

    /**
     * @var string
     *
     * @ORM\Column(name="lib4", type="text", length=50)
     */
    private $lib4;

    /**
     * @var string
     *
     * @ORM\Column(name="lib5", type="text", length=50)
     */
    private $lib5;

    /**
     * @var string
     *
     * @ORM\Column(name="lib6", type="text", length=50)
     */
    private $lib6;

    /**
     * @var string
     *
     * @ORM\Column(name="lib7", type="text", length=50)
     */
    private $lib7;

    /**
     * @var string
     *
     * @ORM\Column(name="lib8", type="text", length=50)
     */
    private $lib8;

    /**
     * @var string
     *
     * @ORM\Column(name="lib9", type="text", length=50)
     */
    private $lib9;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=10)
     */
    private $couleur = '';

    /**
     * @var string
     *
     * @ORM\Column(name="imgcouleur", type="string", length=100)
     */
    private $imgcouleur = '';

    /**
     * @var string
     *
     * @ORM\Column(name="nomcouleur", type="string", length=80)
     */
    private $nomcouleur = '';

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo = '';

    /**
     * @var string
     *
     * @ORM\Column(name="obs", type="text")
     */
    private $obs = '';

    /**
     * @var integer
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
     * @return ModeAcces
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
     * @return ModeAcces
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
     * @return ModeAcces
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
     * @return ModeAcces
     */
    public function setlib1($lib1)
    {
        $this->lib1 = $lib1;

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
     * @return ModeAcces
     */
    public function setlib2($lib2)
    {
        $this->lib2 = $lib2;

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
     * @return ModeAcces
     */
    public function setlib3($lib3)
    {
        $this->lib3 = $lib3;

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
     * @return ModeAcces
     */
    public function setlib4($lib4)
    {
        $this->lib4 = $lib4;

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
     * @return ModeAcces
     */
    public function setlib5($lib5)
    {
        $this->lib5 = $lib5;

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
     * @return ModeAcces
     */
    public function setlib6($lib6)
    {
        $this->lib6 = $lib6;

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
     * @return ModeAcces
     */
    public function setlib7($lib7)
    {
        $this->lib7 = $lib7;

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
     * @return ModeAcces
     */
    public function setlib8($lib8)
    {
        $this->lib8 = $lib8;

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
     * @return ModeAcces
     */
    public function setlib9($lib9)
    {
        $this->lib9 = $lib9;

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
     * Set couleur
     *
     * @param string $couleur
     *
     * @return ModeAcces
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set imgcouleur
     *
     * @param string $imgcouleur
     *
     * @return ModeAcces
     */
    public function setImgcouleur($imgcouleur)
    {
        $this->imgcouleur = $imgcouleur;

        return $this;
    }

    /**
     * Get imgcouleur
     *
     * @return string
     */
    public function getImgcouleur()
    {
        return $this->imgcouleur;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return ModeAcces
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getlogo()
    {
        return $this->logo;
    }

    /**
     * Set nomcouleur
     *
     * @param string $nomcouleur
     *
     * @return ModeAcces
     */
    public function setNomcouleur($nomcouleur)
    {
        $this->nomcouleur = $nomcouleur;

        return $this;
    }

    /**
     * Get nomcouleur
     *
     * @return string
     */
    public function getNomcouleur()
    {
        return $this->nomcouleur;
    }

    /**
     * Set obs
     *
     * @param string $obs
     *
     * @return ModeAcces
     */
    public function setObs($obs)
    {
        $this->obs = $obs;

        return $this;
    }

    /**
     * Get obs
     *
     * @return string
     */
    public function getObs()
    {
        return $this->obs;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return ModeAcces
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }
}
