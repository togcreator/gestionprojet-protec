<?php

namespace ProjectBundle\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resultat
 *
 * @ORM\Table(name="param_projet_resultat")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Back\ResultatRepository")$
 * @ProjectBundle\Annotation\Label\LabelClass
 */
class Resultat
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
     * @ORM\Column(name="lib0", type="text", length=80)
     */
    private $lib0 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib1", type="text", length=80)
     */
    private $lib1 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib2", type="text", length=80)
     */
    private $lib2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib3", type="text", length=80)
     */
    private $lib3 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib4", type="text", length=80)
     */
    private $lib4 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib5", type="text", length=80)
     */
    private $lib5 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib6", type="text", length=80)
     */
    private $lib6 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib7", type="text", length=80)
     */
    private $lib7 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib8", type="text", length=80)
     */
    private $lib8 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lib9", type="text", length=80)
     */
    private $lib9 = '';

     /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=10)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="nomcouleur", type="string", length=20)
     */
    private $nomcouleur;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="imgcouleur", type="string", length=100)
     */
    private $imgcouleur;

    /**
     * @var text
     *
     * @ORM\Column(name="obs", type="text")
     */
    private $obs;

    /**
     * @var int
     *
     * @ORM\Column(name="version", type="integer", length=11)
     */
    private $version;

    /**
     * @var object
     */
    private $etapejalons;

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
     * @return Resultat
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
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return Resultat
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Set lib0
     *
     * @param string $lib0
     *
     * @return Resultat
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
     * @return Resultat
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
     * @return Resultat
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
     * @return Resultat
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
     * @return Resultat
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
     * @return Resultat
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
     * @return Resultat
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
     * @return Resultat
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
     * @return Resultat
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
     * @return Resultat
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
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Priorites
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
     * @return Priorites
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
     * @return Priorites
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
     * @return Priorites
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
     * @return Priorites
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
     * @return Resultat
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

    /**
     * Set etapejalons
     *
     * @param integer $etapejalons
     *
     * @return Jalon
     */
    public function setEtapejalons($etapejalons)
    {
        $this->etapejalons = $etapejalons;

        return $this;
    }

    /**
     * Get etapejalons
     *
     * @return int
     */
    public function getEtapejalons()
    {
        return $this->etapejalons;
    }
}

