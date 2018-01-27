<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectsFilters
 *
 * @ProjectBundle\Annotation\Date\DateClass
 * @ProjectBundle\Annotation\Label\LabelClass
 * @ORM\Table(name="projets_filtres")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectsFiltersRepository")
 */
class ProjectsFilters
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
     * @var int
     *
     * @ORM\Column(name="idEntiteJ", type="integer", length=11)
     */
    private $idEntiteJ = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idWorkshop", type="integer", length=11)
     */
    private $idWorkshop = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idLeader", type="integer", length=11)
     */
    private $idLeader = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="statut", type="integer", length=11)
     */
    private $statut = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="modeAcces", type="integer", length=11)
     */
    private $modeAcces = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idResultat", type="integer", length=11)
     */
    private $idResultat = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idStatut", type="integer", length=11)
     */
    private $idStatut = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idStatutO", type="integer", length=11)
     */
    private $idStatutO = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idResultatO", type="integer", length=11)
     */
    private $idResultatO = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idPriorite", type="integer", length=11)
     */
    private $idPriorite = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idAlerte", type="integer", length=11)
     */
    private $idAlerte = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idJalon", type="integer", length=11)
     */
    private $idJalon = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer", length=11)
     */
    private $idUser = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idBusinessUnit", type="integer", length=11)
     */
    private $idBusinessUnit = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idRelationProfessionnelles", type="integer", length=11)
     */
    private $idRelationProfessionnelles = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idContact", type="integer", length=11)
     */
    private $idContact = 0;

    /**
     * @var integer
     */
    private $title = 0;

    /**
     * @var integer
     */
    private $mode = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="flagprive", type="integer", length=1)
     */
    private $flagprive = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="tri", type="string", length=50)
     */
    private $tri = '';

    /**
     * @var \Date
     *
     * @ORM\Column(name="datedebut_prevueE", type="date")
     */
    private $datedebutPrevueE;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datefin_prevueE", type="date")
     */
    private $datefinPrevueE;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datedebut_prevueO", type="date")
     */
    private $datedebutPrevueO;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datefinPrevueO", type="date")
     */
    private $datefinPrevueO;


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
     * @return ProjectsFilters
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
     * @return ProjectsFilters
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
     * @return ProjectsFilters
     */
    public function setLib1($lib1)
    {
        $this->lib1 = $lib1 ? $lib1 : $this->lib1;

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
     * @return ProjectsFilters
     */
    public function setLib2($lib2)
    {
        $this->lib2 = $lib2 ? $lib2 : $this->lib2;

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
     * @return ProjectsFilters
     */
    public function setLib3($lib3)
    {
        $this->lib3 = $lib3 ? $lib3 : $this->lib3;

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
     * @return ProjectsFilters
     */
    public function setLib4($lib4)
    {
        $this->lib4 = $lib4 ? $lib4 : $this->lib4;

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
     * @return ProjectsFilters
     */
    public function setLib5($lib5)
    {
        $this->lib5 = $lib5 ? $lib5 : $this->lib5;

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
     * @return ProjectsFilters
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
     * @return ProjectsFilters
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
     * @return ProjectsFilters
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
     * @return ProjectsFilters
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
     * Set idEntiteJ
     *
     * @param integer $idEntiteJ
     *
     * @return ProjectsFilters
     */
    public function setIdEntiteJ($idEntiteJ)
    {
        $this->idEntiteJ = $idEntiteJ ? $idEntiteJ : $this->idEntiteJ;

        return $this;
    }

    /**
     * Get idEntiteJ
     *
     * @return int
     */
    public function getIdEntiteJ()
    {
        return $this->idEntiteJ;
    }

    /**
     * Set idWorkshop
     *
     * @param integer $idWorkshop
     *
     * @return ProjectsFilters
     */
    public function setIdWorkshop($idWorkshop)
    {
        $this->idWorkshop = $idWorkshop ? $idWorkshop : $this->idWorkshop;

        return $this;
    }

    /**
     * Get idWorkshop
     *
     * @return int
     */
    public function getIdWorkshop()
    {
        return $this->idWorkshop;
    }

    /**
     * Set idLeader
     *
     * @param integer $idLeader
     *
     * @return ProjectsFilters
     */
    public function setIdLeader($idLeader)
    {
        $this->idLeader = $idLeader ? $idLeader : $this->idLeader;

        return $this;
    }

    /**
     * Get idLeader
     *
     * @return int
     */
    public function getIdLeader()
    {
        return $this->idLeader;
    }

    /**
     * Set statut
     *
     * @param integer $statut
     *
     * @return ProjectsFilters
     */
    public function setStatut($statut)
    {
        $this->statut = $statut ? $statut : $this->statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return int
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set modeAcces
     *
     * @param integer $modeAcces
     *
     * @return ProjectsFilters
     */
    public function setModeAcces($modeAcces)
    {
        $this->modeAcces = $modeAcces ? $modeAcces : $this->modeAcces;

        return $this;
    }

    /**
     * Get modeAcces
     *
     * @return int
     */
    public function getModeAcces()
    {
        return $this->modeAcces;
    }

    /**
     * Set idResultat
     *
     * @param integer $idResultat
     *
     * @return ProjectsFilters
     */
    public function setIdResultat($idResultat)
    {
        $this->idResultat = $idResultat ? $idResultat : $this->idResultat;

        return $this;
    }

    /**
     * Get idResultat
     *
     * @return int
     */
    public function getIdResultat()
    {
        return $this->idResultat;
    }

    /**
     * Set idStatut
     *
     * @param integer $idStatut
     *
     * @return ProjectsFilters
     */
    public function setIdStatut($idStatut)
    {
        $this->idStatut = $idStatut ? $idStatut : $this->idStatut;

        return $this;
    }

    /**
     * Get idStatut
     *
     * @return int
     */
    public function getIdStatut()
    {
        return $this->idStatut;
    }

    /**
     * Set idStatutO
     *
     * @param integer $idStatutO
     *
     * @return ProjectsFilters
     */
    public function setIdStatutO($idStatutO)
    {
        $this->idStatutO = $idStatutO ? $idStatutO : $this->idStatutO;

        return $this;
    }

    /**
     * Get idStatutO
     *
     * @return int
     */
    public function getIdStatutO()
    {
        return $this->idStatutO;
    }

    /**
     * Set idResultatO
     *
     * @param integer $idResultatO
     *
     * @return ProjectsFilters
     */
    public function setIdResultatO($idResultatO)
    {
        $this->idResultatO = $idResultatO ? $idResultatO : $this->idResultatO;

        return $this;
    }

    /**
     * Get idResultatO
     *
     * @return int
     */
    public function getIdResultatO()
    {
        return $this->idResultatO;
    }

    /**
     * Set idPriorite
     *
     * @param integer $idPriorite
     *
     * @return ProjectsFilters
     */
    public function setIdPriorite($idPriorite)
    {
        $this->idPriorite = $idPriorite ? $idPriorite : $this->idPriorite;

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
     * Set idJalon
     *
     * @param integer $idJalon
     *
     * @return ProjectsFilters
     */
    public function setIdJalon($idJalon)
    {
        $this->idJalon = $idJalon ? $idJalon : $this->idJalon;

        return $this;
    }

    /**
     * Get idJalon
     *
     * @return int
     */
    public function getIdJalon()
    {
        return $this->idJalon;
    }

    /**
     * Set idAlerte
     *
     * @param integer $idAlerte
     *
     * @return ProjectsFilters
     */
    public function setIdAlerte($idAlerte)
    {
        $this->idAlerte = $idAlerte ? $idAlerte : $this->idAlerte;

        return $this;
    }

    /**
     * Get idAlerte
     *
     * @return int
     */
    public function getIdAlerte()
    {
        return $this->idAlerte;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return ProjectsFilters
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser ? $idUser : $this->idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idContact
     *
     * @param integer $idContact
     *
     * @return ProjectsFilters
     */
    public function setIdContact($idContact)
    {
        $this->idContact = $idContact ? $idContact : $this->idContact;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdContact()
    {
        return $this->idContact;
    }

    /**
     * Set title
     *
     * @param integer $title
     *
     * @return ProjectsFilters
     */
    public function setTitle($title)
    {
        $this->title = $title ? $title : $this->title;

        return $this;
    }

    /**
     * Get title
     *
     * @return int
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set mode
     *
     * @param integer $mode
     *
     * @return ProjectsFilters
     */
    public function setMode($mode)
    {
        $this->mode = $mode != null ? $mode : $this->mode;

        return $this;
    }

    /**
     * Get mode
     *
     * @return int
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Set flagprive
     *
     * @param boolean $flagprive
     *
     * @return ProjectsFilters
     */
    public function setFlagprive($flagprive)
    {
        $this->flagprive = $flagprive ? $flagprive : $this->flagprive;

        return $this;
    }

    /**
     * Get flagprive
     *
     * @return int
     */
    public function getFlagprive()
    {
        return $this->flagprive;
    }

    /**
     * Set tri
     *
     * @param string $tri
     *
     * @return ProjectsFilters
     */
    public function setTri($tri)
    {
        $this->tri = $tri ? $tri : $this->tri;

        return $this;
    }

    /**
     * Get tri
     *
     * @return int
     */
    public function getTri()
    {
        return $this->tri;
    }

    /**
     * Set datedebutPrevueE
     *
     * @param \Date $datedebutPrevueE
     *
     * @return ProjectsFilters
     */
    public function setDatedebutPrevueE($datedebutPrevueE)
    {
        $this->datedebutPrevueE = $datedebutPrevueE;

        return $this;
    }

    /**
     * Get datedebutPrevueE
     *
     * @return \Date
     */
    public function getDatedebutPrevueE()
    {
        return $this->datedebutPrevueE;
    }

    /**
     * Set datefinPrevueE
     *
     * @param \Date $datefinPrevueE
     *
     * @return ProjectsFilters
     */
    public function setDatefinPrevueE($datefinPrevueE)
    {
        $this->datefinPrevueE = $datefinPrevueE;

        return $this;
    }

    /**
     * Get datefinPrevueE
     *
     * @return \Date
     */
    public function getDatefinPrevueE()
    {
        return $this->datefinPrevueE;
    }

    /**
     * Set datefinPrevueO
     *
     * @param \Date $datefinPrevueO
     *
     * @return ProjectsFilters
     */
    public function setDatedebutPrevueO($datefinPrevueO)
    {
        $this->datefinPrevueO = $datefinPrevueO;

        return $this;
    }

    /**
     * Get datefinPrevueO
     *
     * @return \Date
     */
    public function getDatedebutPrevueO()
    {
        return $this->datefinPrevueO;
    }

    /**
     * Set datedebutPrevueO
     *
     * @param \Date $datedebutPrevueO
     *
     * @return ProjectsFilters
     */
    public function setDatefinPrevueO($datedebutPrevueO)
    {
        $this->datedebutPrevueO = $datedebutPrevueO;

        return $this;
    }

    /**
     * Get datedebutPrevueO
     *
     * @return \Date
     */
    public function getDatefinPrevueO()
    {
        return $this->datedebutPrevueO;
    }

    /**
     * Set idBusinessUnit
     *
     * @param integer $idBusinessUnit
     *
     * @return ProjectsFilters
     */
    public function setIdBusinessUnit($idBusinessUnit)
    {
        $this->idBusinessUnit = $idBusinessUnit;

        return $this;
    }

    /**
     * Get idBusinessUnit
     *
     * @return integer
     */
    public function getIdBusinessUnit()
    {
        return $this->idBusinessUnit;
    }

    /**
     * Set idRelationProfessionnelles
     *
     * @param integer $idRelationProfessionnelles
     *
     * @return ProjectsFilters
     */
    public function setIdRelationProfessionnelles($idRelationProfessionnelles)
    {
        $this->idRelationProfessionnelles = $idRelationProfessionnelles;

        return $this;
    }

    /**
     * Get idRelationProfessionnelles
     *
     * @return integer
     */
    public function getIdRelationProfessionnelles()
    {
        return $this->idRelationProfessionnelles;
    }
}
