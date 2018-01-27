<?php

namespace CrmBundle\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmParamAlert
 *
 * @ORM\Table(name="param_crm_alertes")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\Back\CrmParamAlertRepository")
 * @ProjectBundle\Annotation\Label\LabelClass
 */
class CrmParamAlert
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
     * @ORM\Column(name="typeAlerte", type="integer")
     */
    private $typeAlerte;

    /**
     * @var int
     *
     * @ORM\Column(name="declenchementdelai", type="integer")
     */
    private $declenchementdelai = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="typedelai", type="string", length=10)
     */
    private $typedelai = '';

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=10)
     */
    private $couleur = '';

    /**
     * @var string
     *
     * @ORM\Column(name="nomcouleur", type="string", length=20)
     */
    private $nomcouleur = '';

    /**
     * @var string
     *
     * @ORM\Column(name="obligatoire", type="string", length=1)
     */
    private $obligatoire;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo = '';

    /**
     * @var int
     *
     * @ORM\Column(name="valide", type="integer")
     */
    private $valide = 0;

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
     * @return CrmParamAlert
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
     * Set typeAlerte
     *
     * @param integer $typeAlerte
     *
     * @return CrmParamAlert
     */
    public function setTypeAlerte($typeAlerte)
    {
        $this->typeAlerte = $typeAlerte;

        return $this;
    }

    /**
     * Get typeAlerte
     *
     * @return int
     */
    public function getTypeAlerte()
    {
        return $this->typeAlerte;
    }

    /**
     * Set declenchementdelai
     *
     * @param integer $declenchementdelai
     *
     * @return CrmParamAlert
     */
    public function setDeclenchementdelai($declenchementdelai)
    {
        $this->declenchementdelai = $declenchementdelai ? $declenchementdelai : $this->declenchementdelai;

        return $this;
    }

    /**
     * Get declenchementdelai
     *
     * @return int
     */
    public function getDeclenchementdelai()
    {
        return $this->declenchementdelai;
    }

    /**
     * Set typedelai
     *
     * @param string $typedelai
     *
     * @return CrmParamAlert
     */
    public function setTypedelai($typedelai)
    {
        $this->typedelai = $typedelai ? $typedelai : $this->typedelai;

        return $this;
    }

    /**
     * Get typedelai
     *
     * @return string
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
     * @return CrmParamAlert
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
     * Set nomcouleur
     *
     * @param string $nomcouleur
     *
     * @return CrmParamAlert
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

    /**
     * Set obligatoire
     *
     * @param string $obligatoire
     *
     * @return CrmParamAlert
     */
    public function setObligatoire($obligatoire)
    {
        $this->obligatoire = $obligatoire;

        return $this;
    }

    /**
     * Get obligatoire
     *
     * @return string
     */
    public function getObligatoire()
    {
        return $this->obligatoire;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return CrmParamAlert
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
     * Set valide
     *
     * @param integer $valide
     *
     * @return CrmParamAlert
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
     * @return CrmParamAlert
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
     * @return CrmParamAlert
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
     * @return CrmParamAlert
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
     * @return CrmParamAlert
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
     * @return CrmParamAlert
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
     * @return CrmParamAlert
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
     * @return CrmParamAlert
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
     * @return CrmParamAlert
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
     * @return CrmParamAlert
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
     * @return CrmParamAlert
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
     * @return CrmParamAlert
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
}
