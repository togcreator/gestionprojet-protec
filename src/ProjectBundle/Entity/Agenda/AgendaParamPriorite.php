<?php

namespace ProjectBundle\Entity\Agenda;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgendaParamPriorite
 *
 * @ORM\Table(name="agenda_agenda_param_priorite")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Agenda\AgendaParamPrioriteRepository")
 */
class AgendaParamPriorite
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
     * @ORM\Column(name="idTypeagenda", type="integer", length=11)
     */
    private $idTypeagenda;

    /**
     * @var int
     *
     * @ORM\Column(name="ouvert", type="integer", length=11)
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
     *
     * @ORM\Column(name="lib0", type="string", length=50)
     */
    private $lib0;

    /**
     * @var string
     *
     * @ORM\Column(name="lib1", type="string", length=50)
     */
    private $lib1;

    /**
     * @var string
     *
     * @ORM\Column(name="lib3", type="string", length=50)
     */
    private $lib3;

    /**
     * @var string
     *
     * @ORM\Column(name="lib4", type="string", length=50)
     */
    private $lib4;

    /**
     * @var string
     *
     * @ORM\Column(name="lib5", type="string", length=50)
     */
    private $lib5;

    /**
     * @var string
     *
     * @ORM\Column(name="lib6", type="string", length=50)
     */
    private $lib6;

    /**
     * @var string
     *
     * @ORM\Column(name="lib7", type="string", length=50)
     */
    private $lib7;

    /**
     * @var string
     *
     * @ORM\Column(name="lib8", type="string", length=50)
     */
    private $lib8;

    /**
     * @var string
     *
     * @ORM\Column(name="lib9", type="string", length=50)
     */
    private $lib9;

    /**
     * @var int
     *
     * @ORM\Column(name="delai", type="integer", length=11)
     */
    private $delai;

    /**
     * @var int
     *
     * @ORM\Column(name="typedelai", type="integer", length=11)
     */
    private $typedelai;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=10)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="imgcouleur", type="string", length=100)
     */
    private $imgcouleur;

    /**
     * @var string
     *
     * @ORM\Column(name="nomcouleur", type="string", length=80)
     */
    private $nomcouleur;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255)
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="obs", type="text")
     */
    private $obs;

    /**
     * @var int
     *
     * @ORM\Column(name="valide", type="integer", length=11)
     */
    private $valide;

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
     * Set idTypeagenda
     *
     * @param integer $idTypeagenda
     *
     * @return AgendaParamPriorite
     */
    public function setIdTypeagenda($idTypeagenda)
    {
        $this->idTypeagenda = $idTypeagenda;

        return $this;
    }

    /**
     * Get idTypeagenda
     *
     * @return int
     */
    public function getIdTypeagenda()
    {
        return $this->idTypeagenda;
    }

    /**
     * Set ouvert
     *
     * @param integer $ouvert
     *
     * @return AgendaParamPriorite
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
     * @return AgendaParamPriorite
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
     * Set lib0
     *
     * @param string $lib0
     *
     * @return AgendaParamPriorite
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
     * @return AgendaParamPriorite
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
     * Set lib3
     *
     * @param string $lib3
     *
     * @return AgendaParamPriorite
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
     * @return AgendaParamPriorite
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
     * @return AgendaParamPriorite
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
     * @return AgendaParamPriorite
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
     * @return AgendaParamPriorite
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
     * @return AgendaParamPriorite
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
     * @return AgendaParamPriorite
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
     * Set delai
     *
     * @param integer $delai
     *
     * @return AgendaParamPriorite
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
     * Set typedelai
     *
     * @param integer $typedelai
     *
     * @return AgendaParamPriorite
     */
    public function setTypedelai($typedelai)
    {
        $this->typedelai = $typedelai;

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
     * @return AgendaParamPriorite
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
     * @return AgendaParamPriorite
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
     * Set nomcouleur
     *
     * @param string $nomcouleur
     *
     * @return AgendaParamPriorite
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
     * Set img
     *
     * @param string $img
     *
     * @return AgendaParamPriorite
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set obs
     *
     * @param string $obs
     *
     * @return AgendaParamPriorite
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
     * Set valide
     *
     * @param integer $valide
     *
     * @return AgendaParamPriorite
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
     * @return AgendaParamPriorite
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

