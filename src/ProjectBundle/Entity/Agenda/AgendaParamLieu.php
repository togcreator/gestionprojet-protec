<?php

namespace ProjectBundle\Entity\Agenda;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgendaParamLieu
 *
 * @ORM\Table(name="agenda_agenda_param_lieu")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Agenda\AgendaParamLieuRepository")
 */
class AgendaParamLieu
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
     * @ORM\Column(name="idTypeAgenda", type="integer")
     */
    private $idTypeAgenda;

    /**
     * @var int
     *
     * @ORM\Column(name="ouvert", type="integer")
     */
    private $ouvert;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

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
     * @ORM\Column(name="img", type="string", length=255)
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="couleurFond", type="string", length=255)
     */
    private $couleurFond;

    /**
     * @var string
     *
     * @ORM\Column(name="couleurAlerte", type="string", length=255)
     */
    private $couleurAlerte;

    /**
     * @var string
     *
     * @ORM\Column(name="couleurUrgence", type="string", length=255)
     */
    private $couleurUrgence;

    /**
     * @var string
     *
     * @ORM\Column(name="couleurSurveillance", type="string", length=255)
     */
    private $couleurSurveillance;

    /**
     * @var bool
     *
     * @ORM\Column(name="chantier", type="boolean")
     */
    private $chantier;

    /**
     * @var bool
     *
     * @ORM\Column(name="valide", type="boolean")
     */
    private $valide;

    /**
     * @var int
     *
     * @ORM\Column(name="synchro", type="integer")
     */
    private $synchro;

    /**
     * @var int
     *
     * @ORM\Column(name="asynchroniser", type="integer")
     */
    private $asynchroniser;

    /**
     * @var int
     *
     * @ORM\Column(name="created_at", type="integer")
     */
    private $createdAt;

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
     * Set idTypeAgenda
     *
     * @param integer $idTypeAgenda
     *
     * @return AgendaParamLieu
     */
    public function setIdTypeAgenda($idTypeAgenda)
    {
        $this->idTypeAgenda = $idTypeAgenda;

        return $this;
    }

    /**
     * Get idTypeAgenda
     *
     * @return int
     */
    public function getIdTypeAgenda()
    {
        return $this->idTypeAgenda;
    }

    /**
     * Set ouvert
     *
     * @param integer $ouvert
     *
     * @return AgendaParamLieu
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
     * @return AgendaParamLieu
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
     * @return AgendaParamLieu
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
     * @return AgendaParamLieu
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
     * @return AgendaParamLieu
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
     * @return AgendaParamLieu
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
     * @return AgendaParamLieu
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
     * @return AgendaParamLieu
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
     * @return AgendaParamLieu
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
     * @return AgendaParamLieu
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
     * @return AgendaParamLieu
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
     * @return AgendaParamLieu
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
     * Set img
     *
     * @param string $img
     *
     * @return AgendaParamLieu
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
     * Set couleurFond
     *
     * @param string $couleurFond
     *
     * @return AgendaParamLieu
     */
    public function setCouleurFond($couleurFond)
    {
        $this->couleurFond = $couleurFond;

        return $this;
    }

    /**
     * Get couleurFond
     *
     * @return string
     */
    public function getCouleurFond()
    {
        return $this->couleurFond;
    }

    /**
     * Set couleurAlerte
     *
     * @param string $couleurAlerte
     *
     * @return AgendaParamLieu
     */
    public function setCouleurAlerte($couleurAlerte)
    {
        $this->couleurAlerte = $couleurAlerte;

        return $this;
    }

    /**
     * Get couleurAlerte
     *
     * @return string
     */
    public function getCouleurAlerte()
    {
        return $this->couleurAlerte;
    }

    /**
     * Set couleurUrgence
     *
     * @param string $couleurUrgence
     *
     * @return AgendaParamLieu
     */
    public function setCouleurUrgence($couleurUrgence)
    {
        $this->couleurUrgence = $couleurUrgence;

        return $this;
    }

    /**
     * Get couleurUrgence
     *
     * @return string
     */
    public function getCouleurUrgence()
    {
        return $this->couleurUrgence;
    }

    /**
     * Set couleurSurveillance
     *
     * @param string $couleurSurveillance
     *
     * @return AgendaParamLieu
     */
    public function setCouleurSurveillance($couleurSurveillance)
    {
        $this->couleurSurveillance = $couleurSurveillance;

        return $this;
    }

    /**
     * Get couleurSurveillance
     *
     * @return string
     */
    public function getCouleurSurveillance()
    {
        return $this->couleurSurveillance;
    }

    /**
     * Set chantier
     *
     * @param boolean $chantier
     *
     * @return AgendaParamLieu
     */
    public function setChantier($chantier)
    {
        $this->chantier = $chantier;

        return $this;
    }

    /**
     * Get chantier
     *
     * @return bool
     */
    public function getChantier()
    {
        return $this->chantier;
    }

    /**
     * Set valide
     *
     * @param boolean $valide
     *
     * @return AgendaParamLieu
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
     * Set synchro
     *
     * @param integer $synchro
     *
     * @return AgendaParamLieu
     */
    public function setSynchro($synchro)
    {
        $this->synchro = $synchro;

        return $this;
    }

    /**
     * Get synchro
     *
     * @return int
     */
    public function getSynchro()
    {
        return $this->synchro;
    }

    /**
     * Set asynchroniser
     *
     * @param integer $asynchroniser
     *
     * @return AgendaParamLieu
     */
    public function setAsynchroniser($asynchroniser)
    {
        $this->asynchroniser = $asynchroniser;

        return $this;
    }

    /**
     * Get asynchroniser
     *
     * @return int
     */
    public function getAsynchroniser()
    {
        return $this->asynchroniser;
    }

    /**
     * Set createdAt
     *
     * @param integer $createdAt
     *
     * @return AgendaParamLieu
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return AgendaParamLieu
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

