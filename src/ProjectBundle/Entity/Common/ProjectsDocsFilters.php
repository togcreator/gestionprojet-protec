<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectsDocsFilters
 *
 * @ProjectBundle\Annotation\Date\DateClass
 * @ProjectBundle\Annotation\Label\LabelClass
 * @ORM\Table(name="projets_docsfiltres")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectsDocsFiltersRepository")
 */
class ProjectsDocsFilters
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
     * @ORM\Column(name="prevision", type="integer", length=60)
     */
    private $prevision = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="realisation", type="integer", length=60)
     */
    private $realisation = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idWorkshop", type="integer", length=11)
     */
    private $idWorkshop = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="responsible", type="integer", length=11)
     */
    private $responsible = 0;

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
     * @ORM\Column(name="idRole", type="integer", length=11)
     */
    private $idRole = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idRoleO", type="integer", length=11)
     */
    private $idRoleO = 0;

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
     * @ORM\Column(name="datedebutPrevueE", type="date")
     */
    private $datedebutPrevueE;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datefinPrevueE", type="date")
     */
    private $datefinPrevueE;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datedebutReelE", type="date")
     */
    private $datedebutReelE;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datefinReelE", type="date")
     */
    private $datefinReelE;

    /**
     * @var integer
     *
     * @ORM\Column(name="dateDebutE", type="integer", length=60)
     */
    private $dateDebutE;

    /**
     * @var integer
     *
     * @ORM\Column(name="dateTermineE", type="integer", length=60)
     */
    private $dateTermineE;

    /**
     * @var integer
     *
     * @ORM\Column(name="dateAvanceE", type="integer", length=60)
     */
    private $dateAvanceE;

    /**
     * @var integer
     *
     * @ORM\Column(name="dateRetardE", type="integer", length=60)
     */
    private $dateRetardE;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datedebutPrevueO", type="date")
     */
    private $datedebutPrevueO;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datefinPrevueO", type="date")
     */
    private $datefinPrevueO;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datedebutReelO", type="date")
     */
    private $datedebutReelO;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datefinReelO", type="date")
     */
    private $datefinReelO;

    /**
     * @var integer
     *
     * @ORM\Column(name="dateDebutO", type="integer", length=60)
     */
    private $dateDebutO;

    /**
     * @var integer
     *
     * @ORM\Column(name="dateTermineO", type="integer", length=60)
     */
    private $dateTermineO;

    /**
     * @var integer
     *
     * @ORM\Column(name="dateAvanceO", type="integer", length=60)
     */
    private $dateAvanceO;

    /**
     * @var integer
     *
     * @ORM\Column(name="dateRetardO", type="integer", length=60)
     */
    private $dateRetardO;

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
     * @return ProjectsDocsFilters
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
     * @return ProjectsDocsFilters
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
     * @return ProjectsDocsFilters
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
     * @return ProjectsDocsFilters
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
     * @return ProjectsDocsFilters
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
     * @return ProjectsDocsFilters
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
     * @return ProjectsDocsFilters
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
     * @return ProjectsDocsFilters
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
     * @return ProjectsDocsFilters
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
     * @return ProjectsDocsFilters
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
     * @return ProjectsDocsFilters
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
     * Set prevision
     *
     * @param integer $prevision
     *
     * @return ProjectsDocsFilters
     */
    public function setPrevision($prevision)
    {
        $this->prevision = $prevision;

        return $this;
    }

    /**
     * Get prevision
     *
     * @return int
     */
    public function getPrevision()
    {
        return $this->prevision;
    }

    /**
     * Set realisation
     *
     * @param integer $realisation
     *
     * @return ProjectsDocsFilters
     */
    public function setRealisation($realisation)
    {
        $this->realisation = $realisation;

        return $this;
    }

    /**
     * Get realisation
     *
     * @return int
     */
    public function getRealisation()
    {
        return $this->realisation;
    }

    /**
     * Set idWorkshop
     *
     * @param integer $idWorkshop
     *
     * @return ProjectsDocsFilters
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
     * Set responsible
     *
     * @param integer $responsible
     *
     * @return ProjectsDocsFilters
     */
    public function setResponsible($responsible)
    {
        $this->responsible = $responsible ? $responsible : $this->responsible;

        return $this;
    }

    /**
     * Get responsible
     *
     * @return int
     */
    public function getResponsible()
    {
        return $this->responsible;
    }

    /**
     * Set idRole
     *
     * @param integer $idRole
     *
     * @return ProjectsDocsFilters
     */
    public function setIdRole($idRole)
    {
        $this->idRole = $idRole ? $idRole : $this->idRole;

        return $this;
    }

    /**
     * Get idRole
     *
     * @return int
     */
    public function getIdRole()
    {
        return $this->idRole;
    }

    /**
     * Set idRoleO
     *
     * @param integer $idRoleO
     *
     * @return ProjectsDocsFilters
     */
    public function setIdRoleO($idRole)
    {
        $this->idRoleO = $idRoleO ? $idRoleO : $this->idRoleO;

        return $this;
    }

    /**
     * Get idRoleO
     *
     * @return int
     */
    public function getIdRoleO()
    {
        return $this->idRoleO;
    }

    /**
     * Set idStatut
     *
     * @param integer $idStatut
     *
     * @return ProjectsDocsFilters
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
     * @return ProjectsDocsFilters
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
     * Set idPriorite
     *
     * @param integer $idPriorite
     *
     * @return ProjectsDocsFilters
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
     * @return ProjectsDocsFilters
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
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return ProjectsDocsFilters
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
     * Set flagprive
     *
     * @param boolean $flagprive
     *
     * @return ProjectsDocsFilters
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
     * @return ProjectsDocsFilters
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
     * @return ProjectsDocsFilters
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
     * Set datedebutReelE
     *
     * @param \Date $datedebutReelE
     *
     * @return ProjectsDocsFilters
     */
    public function setDatedebutReelE($datedebutReelE)
    {
        $this->datedebutReelE = $datedebutReelE;

        return $this;
    }

    /**
     * Get datedebutReelE
     *
     * @return \Date
     */
    public function getDatedebutReelE()
    {
        return $this->datedebutReelE;
    }

    /**
     * Set datefinPrevueE
     *
     * @param \Date $datefinPrevueE
     *
     * @return ProjectsDocsFilters
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
     * Set datefinReelE
     *
     * @param \Date $datefinPrevueE
     *
     * @return ProjectsDocsFilters
     */
    public function setDatefinReelE($datefinReelE)
    {
        $this->datefinReelE = $datefinReelE;

        return $this;
    }

    /**
     * Get datefinReelE
     *
     * @return \Date
     */
    public function getDatefinReelE()
    {
        return $this->datefinReelE;
    }

    /**
     * Set dateDebutE
     *
     * @param integer $dateDebutE
     *
     * @return ProjectsDocsFilters
     */
    public function setDateDebutE($dateDebutE)
    {
        $this->dateDebutE = $dateDebutE ? $dateDebutE : $this->dateDebutE;

        return $this;
    }

    /**
     * Get dateDebutE
     *
     * @return int
     */
    public function getDateDebutE()
    {
        return $this->dateDebutE;
    }

    /**
     * Set dateTermineE
     *
     * @param integer $dateTermineE
     *
     * @return ProjectsDocsFilters
     */
    public function setDateTermineE($dateTermineE)
    {
        $this->dateTermineE = $dateTermineE ? $dateTermineE : $this->dateTermineE;

        return $this;
    }

    /**
     * Get dateTermineE
     *
     * @return int
     */
    public function getDateTermineE()
    {
        return $this->dateTermineE;
    }

    /**
     * Set dateAvanceE
     *
     * @param integer $dateAvanceE
     *
     * @return ProjectsDocsFilters
     */
    public function setDateAvanceE($dateAvanceE)
    {
        $this->dateAvanceE = $dateAvanceE ? $dateAvanceE : $this->dateAvanceE;

        return $this;
    }

    /**
     * Get dateAvanceE
     *
     * @return int
     */
    public function getDateAvanceE()
    {
        return $this->dateAvanceE;
    }

    /**
     * Set dateRetardE
     *
     * @param integer $dateRetardE
     *
     * @return ProjectsDocsFilters
     */
    public function setDateRetardE($dateRetardE)
    {
        $this->dateRetardE = $dateRetardE ? $dateRetardE : $this->dateRetardE;

        return $this;
    }

    /**
     * Get dateRetardE
     *
     * @return int
     */
    public function getDateRetardE()
    {
        return $this->dateRetardE;
    }

    /**
     * Set datedebutPrevueO
     *
     * @param \Date $datedebutPrevueO
     *
     * @return ProjectsDocsFilters
     */
    public function setDatedebutPrevueO($datedebutPrevueO)
    {
        $this->datedebutPrevueO = $datedebutPrevueO;

        return $this;
    }

    /**
     * Get datedebutPrevueO
     *
     * @return \Date
     */
    public function getDatedebutPrevueO()
    {
        return $this->datedebutPrevueO;
    }

    /**
     * Set datefinPrevueO
     *
     * @param \Date $datefinPrevueO
     *
     * @return ProjectsDocsFilters
     */
    public function setDatefinPrevueO($datefinPrevueO)
    {
        $this->datefinPrevueO = $datefinPrevueO;

        return $this;
    }

    /**
     * Get datefinPrevueO
     *
     * @return \Date
     */
    public function getDatefinPrevueO()
    {
        return $this->datefinPrevueO;
    }

    /**
     * Set datedebutReelO
     *
     * @param \Date $datedebutReelO
     *
     * @return ProjectsDocsFilters
     */
    public function setDatedebutReelO($datedebutReelO)
    {
        $this->datedebutReelO = $datedebutReelO;

        return $this;
    }

    /**
     * Get datedebutReelO
     *
     * @return \Date
     */
    public function getDatedebutReelO()
    {
        return $this->datedebutReelO;
    }

    /**
     * Set datefinReelO
     *
     * @param \Date $datefinReelO
     *
     * @return ProjectsDocsFilters
     */
    public function setDatefinReelO($datefinReelO)
    {
        $this->datefinReelO = $datefinReelO;

        return $this;
    }

    /**
     * Get datefinReelO
     *
     * @return \Date
     */
    public function getDatefinReelO()
    {
        return $this->datefinReelO;
    }

    /**
     * Set dateDebutO
     *
     * @param integer $dateDebutO
     *
     * @return ProjectsDocsFilters
     */
    public function setDateDebutO($dateDebutO)
    {
        $this->dateDebutO = $dateDebutO ? $dateDebutO : $this->dateDebutO;

        return $this;
    }

    /**
     * Get dateDebutO
     *
     * @return int
     */
    public function getDateDebutO()
    {
        return $this->dateDebutO;
    }

    /**
     * Set dateTermineO
     *
     * @param integer $dateTermineO
     *
     * @return ProjectsDocsFilters
     */
    public function setDateTermineO($dateTermineO)
    {
        $this->dateTermineO = $dateTermineO ? $dateTermineO : $this->dateTermineO;

        return $this;
    }

    /**
     * Get dateTermineO
     *
     * @return int
     */
    public function getDateTermineO()
    {
        return $this->dateTermineO;
    }

    /**
     * Set dateAvanceO
     *
     * @param integer $dateAvanceO
     *
     * @return ProjectsDocsFilters
     */
    public function setDateAvanceO($dateAvanceO)
    {
        $this->dateAvanceO = $dateAvanceO ? $dateAvanceO : $this->dateAvanceO;

        return $this;
    }

    /**
     * Get dateAvanceO
     *
     * @return int
     */
    public function getDateAvanceO()
    {
        return $this->dateAvanceO;
    }

    /**
     * Set dateRetardO
     *
     * @param integer $dateRetardO
     *
     * @return ProjectsDocsFilters
     */
    public function setDateRetardO($dateRetardO)
    {
        $this->dateRetardO = $dateRetardO ? $dateRetardO : $this->dateRetardO;

        return $this;
    }

    /**
     * Get dateRetardO
     *
     * @return int
     */
    public function getDateRetardO()
    {
        return $this->dateRetardO;
    }
}