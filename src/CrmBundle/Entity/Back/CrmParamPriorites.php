<?php

namespace CrmBundle\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmParamPriorites
 *
 * @ORM\Table(name="param_crm_priorites")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\Back\CrmParamPrioritesRepository")
 * @ProjectBundle\Annotation\Label\LabelClass
 */
class CrmParamPriorites
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10)
     */
    private $code;

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
     * @ORM\Column(name="delai", type="integer")
     */
    private $delai = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="typedelai", type="integer")
     */
    private $typedelai = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=255)
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
     * @ORM\Column(name="nomcouleur", type="string", length=100)
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
     * @var int
     *
     * @ORM\Column(name="valide", type="integer")
     */
    private $valide;

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
     * Set ouvert
     *
     * @param integer $ouvert
     *
     * @return CrmParamPriorites
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
     * Set code
     *
     * @param string $code
     *
     * @return CrmParamPriorites
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
     * Set delai
     *
     * @param integer $delai
     *
     * @return CrmParamPriorites
     */
    public function setDelai($delai)
    {
        $this->delai = $delai ? $delai : $this->delai;

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
     * Set typedelai
     *
     * @param integer $typedelai
     *
     * @return CrmParamPriorites
     */
    public function setTypedelai($typedelai)
    {
        $this->typedelai = $typedelai ? $typedelai : $this->typedelai;

        return $this;
    }

    /**
     * Get typedelai
     *
     * @return int
     */
    public function getTypedelai()
    {
        return $this->typedelai;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return CrmParamPriorites
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur ? $couleur : $this->couleur;

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
     * @return CrmParamPriorites
     */
    public function setImgcouleur($imgcouleur)
    {
        $this->imgcouleur = $imgcouleur ? $imgcouleur : $this->imgcouleur;

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
     * @return CrmParamPriorites
     */
    public function setLogo($logo)
    {
        $this->logo = $logo ? $logo : $this->logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set obs
     *
     * @param string $obs
     *
     * @return CrmParamPriorites
     */
    public function setObs($obs)
    {
        $this->obs = $obs ? $obs : $this->obs;

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
     * Set valide
     *
     * @param integer $valide
     *
     * @return CrmParamPriorites
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return int
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
     * @return CrmParamPriorites
     */
    public function setVersion($version)
    {
        $this->version = $version ? $version : $this->version;

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
     * Set label
     *
     * @param string $label
     *
     * @return CrmParamStatut
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
     * @return CrmParamPriorites
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
     * @return CrmParamPriorites
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
     * @return CrmParamPriorites
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
     * @return CrmParamPriorites
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
     * @return CrmParamPriorites
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
     * @return CrmParamPriorites
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
     * @return CrmParamPriorites
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
     * @return CrmParamPriorites
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
     * @return CrmParamPriorites
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
     * @return CrmParamPriorites
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
     * Set nomcouleur
     *
     * @param string $nomcouleur
     *
     * @return CrmParamPriorites
     */
    public function setNomcouleur($nomcouleur)
    {
        $this->nomcouleur = $nomcouleur ? $nomcouleur : $this->nomcouleur;

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
}
