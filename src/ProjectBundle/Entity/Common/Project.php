<?php

namespace ProjectBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ProjectBundle\Annotation\Label\LabelClass
 * @ProjectBundle\Annotation\Date\DateClass
 * @ORM\Table(name="projet")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Common\ProjectRepository")
 */
class Project
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
     * @ORM\Column(name="idWorkshop", type="integer", length=11)
     */
    private $idWorkshop;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="ProjectBundle\Entity\Back\Workshop", fetch="EAGER")
     * @ORM\JoinColumn(name="idWorkshop", referencedColumnName="id")
     */
    private $workshop;

    /**
     * @var int
     *
     * @ORM\Column(name="idEntiteJ", type="integer", length=11)
     */
    private $idEntiteJ;

    /**
     * @var int
     *
     * @ORM\Column(name="idVersion_encours", type="integer", length=11)
     */
    private $idVersionCours;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=80)
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
     * @var string
     *
     * @ORM\Column(name="icone", type="string", length=80, nullable=true)
     */
    private $icone = '';

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=10)
     */
    private $reference;

    /**
     * @var string
     */
    private $descriptionPerimetres;

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre0", type="text")
     */
    private $descriptionPerimetre0 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre1", type="text")
     */
    private $descriptionPerimetre1 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre2", type="text")
     */
    private $descriptionPerimetre2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre3", type="text")
     */
    private $descriptionPerimetre3 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre4", type="text")
     */
    private $descriptionPerimetre4 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre5", type="text")
     */
    private $descriptionPerimetre5 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre6", type="text")
     */
    private $descriptionPerimetre6 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre7", type="text")
     */
    private $descriptionPerimetre7 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre8", type="text")
     */
    private $descriptionPerimetre8 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre9", type="text")
     */
    private $descriptionPerimetre9 = '';

    /**
     * @var int
     *
     * @ORM\Column(name="idTypeProjet", type="integer", length=11)
     */
    private $idTypeProjet;

    /**
     * @var int
     *
     * @ORM\Column(name="idCreateur", type="integer", length=11)
     */
    private $idCreateur;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="\UsersBundle\Entity\UserClient", fetch="EAGER")
     * @ORM\JoinColumn(name="idCreateur", referencedColumnName="id")
     */
    private $createur;

    /**
     * @var int
     * @ORM\OneToMany(targetEntity="ProjectEtape", mappedBy="projet")
     */
    private $etape;

    /**
     * @var int
     * @ORM\OneToMany(targetEntity="ProjectNotes", mappedBy="project", fetch="EAGER")
     */
    private $notes;

    /**
     * @var \Date
     *
     * @ORM\Column(name="dateCreation", type="date")
     */
    private $dateCreation;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datedebut_prevue", type="date", nullable=true)
     */
    private $datedebutPrevue;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datefin_prevue", type="date", nullable=true)
     */
    private $datefinPrevue;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datedebut_reelle", type="date", nullable=true)
     */
    private $datedebutReelle;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datefin_reelle", type="date", nullable=true)
     */
    private $datefinReelle;

    /**
     * @var int
     *
     * @ORM\Column(name="statut", type="integer", length=11)
     */
    private $statut;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="ProjectBundle\Entity\Back\Statut", fetch="EAGER")
     * @ORM\JoinColumn(name="statut", referencedColumnName="id")
     */
    private $statuts;

    /**
     * @var int
     *
     * @ORM\Column(name="idLeader", type="integer", length=11)
     */
    private $idLeader;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="\UsersBundle\Entity\UserClient", fetch="EAGER")
     * @ORM\JoinColumn(name="idLeader", referencedColumnName="id")
     */
    private $leaders;

    /**
     * @var object
     */
    private $user;

    /**
     * @var object
     */
    private $contact;

    /**
     * @var int
     *
     * @ORM\Column(name="joursHommes_prevus", type="integer", length=11, nullable=true)
     */
    private $joursHommesPrevus = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="joursHommes_reels", type="integer", length=11, nullable=true)
     */
    private $joursHommesReels = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="modeAcces", type="integer", length=11)
     */
    private $modeAcces;


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
    * Set user
    *
    * @param object $user
    *
    * @return Project
    */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return object
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set idWorkshop
     *
     * @param integer $idWorkshop
     *
     * @return Project
     */
    public function setIdWorkshop($idWorkshop)
    {
        $this->idWorkshop = $idWorkshop;

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
     * Set workshop
     *
     * @param integer $workshop
     * @return Project
     */
    public function setWorkshop(\ProjectBundle\Entity\Back\Workshop $workshop)
    {
        $this->workshop = $workshop;

        return $this;
    }

    /**
     * Get workshop
     *
     * @return int
     */
    public function getWorkshop()
    {
        return $this->workshop;
    }

    /**
     * Set projectversion
     */
    public function setProjectversion($projectversion)
    {
        $this->projectversion = $projectversion;

        return $this;
    }

    /**
     * Get projectversion
     */
    public function getProjectversion()
    {
        return $this->projectversion;
    }

    /**
     * Set idEntiteJ
     *
     * @param integer $idEntiteJ
     *
     * @return Project
     */
    public function setIdEntiteJ($idEntiteJ)
    {
        $this->idEntiteJ = $idEntiteJ;

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
     * Set idVersionCours
     *
     * @param integer $idVersionCours
     *
     * @return Project
     */
    public function setIdVersionCours($idVersionCours)
    {
        $this->idVersionCours = $idVersionCours;

        return $this;
    }

    /**
     * Get idVersionCours
     *
     * @return int
     */
    public function getIdVersionCours()
    {
        return $this->idVersionCours;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Project
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
     * Set label
     * @ORM\postPersist
     * @param string $label
     * @return Project
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
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
     * @return Project
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
     * @return Project
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
     * @return Project
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
     * @return Project
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
     * @return Project
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
     * @return Project
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
     * @return Project
     */
    public function setlib6($lib6)
    {
        $this->lib6 = $lib6 ? $lib6 : $this->lib6;

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
     * @return Project
     */
    public function setlib7($lib7)
    {
        $this->lib7 = $lib7 ? $lib7 : $this->lib7;

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
     * @return Project
     */
    public function setlib8($lib8)
    {
        $this->lib8 = $lib8 ? $lib8 : $this->lib8;

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
     * @return Project
     */
    public function setlib9($lib9)
    {
        $this->lib9 = $lib9 ? $lib9 : $this->lib9;

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
     * Set icone
     *
     * @param string $icone
     *
     * @return Project
     */
    public function setIcone($icone)
    {
        $this->icone = $icone;

        return $this;
    }

    /**
     * Get icone
     *
     * @return string
     */
    public function getIcone()
    {
        return $this->icone;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Project
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set descriptionPerimetre
     *
     * @param string $descriptionPerimetre
     *
     * @return Project
     */
    public function setDescriptionPerimetres($descriptionPerimetres)
    {
        $this->descriptionPerimetres = $descriptionPerimetres;

        return $this;
    }

    /**
     * Get descriptionPerimetre
     *
     * @return string
     */
    public function getDescriptionPerimetres()
    {
        return $this->descriptionPerimetres;
    }

    /**
     * Set descriptionPerimetre0
     *
     * @param string $descriptionPerimetre0
     *
     * @return Project
     */
    public function setDescriptionPerimetre0($descriptionPerimetre0)
    {
        $this->descriptionPerimetre0 = $descriptionPerimetre0 ? $descriptionPerimetre0 : $this->descriptionPerimetre0;

        return $this;
    }

    /**
     * Get descriptionPerimetre0
     *
     * @return string
     */
    public function getDescriptionPerimetre0()
    {
        return $this->descriptionPerimetre0;
    }

    /**
     * Set descriptionPerimetre1
     *
     * @param string $descriptionPerimetre1
     *
     * @return Project
     */
    public function setDescriptionPerimetre1($descriptionPerimetre1)
    {
        $this->descriptionPerimetre1 = $descriptionPerimetre1 ? $descriptionPerimetre1 : $this->descriptionPerimetre1;

        return $this;
    }

    /**
     * Get descriptionPerimetre1
     *
     * @return string
     */
    public function getDescriptionPerimetre1()
    {
        return $this->descriptionPerimetre1;
    }

    /**
     * Set descriptionPerimetre2
     *
     * @param string $descriptionPerimetre2
     *
     * @return Project
     */
    public function setDescriptionPerimetre2($descriptionPerimetre2)
    {
        $this->descriptionPerimetre2 = $descriptionPerimetre2 ? $descriptionPerimetre2 : $this->descriptionPerimetre2;

        return $this;
    }

    /**
     * Get descriptionPerimetre2
     *
     * @return string
     */
    public function getDescriptionPerimetre2()
    {
        return $this->descriptionPerimetre2;
    }

    /**
     * Set descriptionPerimetre3
     *
     * @param string $descriptionPerimetre3
     *
     * @return Project
     */
    public function setDescriptionPerimetre3($descriptionPerimetre3)
    {
        $this->descriptionPerimetre3 = $descriptionPerimetre3 ? $descriptionPerimetre3 : $this->descriptionPerimetre3;

        return $this;
    }

    /**
     * Get descriptionPerimetre3
     *
     * @return string
     */
    public function getDescriptionPerimetre3()
    {
        return $this->descriptionPerimetre3;
    }

    /**
     * Set descriptionPerimetre4
     *
     * @param string $descriptionPerimetre4
     *
     * @return Project
     */
    public function setDescriptionPerimetre4($descriptionPerimetre4)
    {
        $this->descriptionPerimetre4 = $descriptionPerimetre4 ? $descriptionPerimetre4 : $this->descriptionPerimetre4;

        return $this;
    }

    /**
     * Get descriptionPerimetre4
     *
     * @return string
     */
    public function getDescriptionPerimetre4()
    {
        return $this->descriptionPerimetre4;
    }

    /**
     * Set descriptionPerimetre5
     *
     * @param string $descriptionPerimetre5
     *
     * @return Project
     */
    public function setDescriptionPerimetre5($descriptionPerimetre5)
    {
        $this->descriptionPerimetre5 = $descriptionPerimetre5 ? $descriptionPerimetre5 : $this->descriptionPerimetre5;

        return $this;
    }

    /**
     * Get descriptionPerimetre5
     *
     * @return string
     */
    public function getDescriptionPerimetre5()
    {
        return $this->descriptionPerimetre5;
    }

    /**
     * Set descriptionPerimetre6
     *
     * @param string $descriptionPerimetre6
     *
     * @return Project
     */
    public function setDescriptionPerimetre6($descriptionPerimetre6)
    {
        $this->descriptionPerimetre6 = $descriptionPerimetre6 ? $descriptionPerimetre6 : $this->descriptionPerimetre6;

        return $this;
    }

    /**
     * Get descriptionPerimetre6
     *
     * @return string
     */
    public function getDescriptionPerimetre6()
    {
        return $this->descriptionPerimetre6;
    }

    /**
     * Set descriptionPerimetre7
     *
     * @param string $descriptionPerimetre7
     *
     * @return Project
     */
    public function setDescriptionPerimetre7($descriptionPerimetre7)
    {
        $this->descriptionPerimetre7 = $descriptionPerimetre7 ? $descriptionPerimetre7 : $this->descriptionPerimetre7;

        return $this;
    }

    /**
     * Get descriptionPerimetre7
     *
     * @return string
     */
    public function getDescriptionPerimetre7()
    {
        return $this->descriptionPerimetre7;
    }

    /**
     * Set descriptionPerimetre8
     *
     * @param string $descriptionPerimetre8
     *
     * @return Project
     */
    public function setDescriptionPerimetre8($descriptionPerimetre8)
    {
        $this->descriptionPerimetre8 = $descriptionPerimetre8 ? $descriptionPerimetre8 : $this->descriptionPerimetre8;

        return $this;
    }

    /**
     * Get descriptionPerimetre8
     *
     * @return string
     */
    public function getDescriptionPerimetre8()
    {
        return $this->descriptionPerimetre8;
    }

    /**
     * Set descriptionPerimetre9
     *
     * @param string $descriptionPerimetre9
     *
     * @return Project
     */
    public function setDescriptionPerimetre9($descriptionPerimetre9)
    {
        $this->descriptionPerimetre9 = $descriptionPerimetre9 ? $descriptionPerimetre9 : $this->descriptionPerimetre9;

        return $this;
    }

    /**
     * Get descriptionPerimetre9
     *
     * @return string
     */
    public function getDescriptionPerimetre9()
    {
        return $this->descriptionPerimetre9;
    }

    /**
     * Set idTypeProjet
     *
     * @param integer $idTypeProjet
     *
     * @return Project
     */
    public function setIdTypeProjet($idTypeProjet)
    {
        $this->idTypeProjet = $idTypeProjet;

        return $this;
    }

    /**
     * Get idTypeProjet
     *
     * @return int
     */
    public function getIdTypeProjet()
    {
        return $this->idTypeProjet;
    }

    /**
     * Set idCreateur
     *
     * @param integer $idCreateur
     *
     * @return Project
     */
    public function setIdCreateur($idCreateur)
    {
        $this->idCreateur = $idCreateur;

        return $this;
    }

    /**
     * Get idCreateur
     *
     * @return int
     */
    public function getIdCreateur()
    {
        return $this->idCreateur;
    }

    /**
     * Set Createur
     *
     * @param integer $icreateur
     *
     * @return Project
     */
    public function setCreateur($createur)
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * Get createur
     *
     * @return object
     */
    public function getCreateur()
    {
        return $this->createur;
    }

    /**
     * Set Etape
     *
     * @param integer $etape
     *
     * @return Project
     */
    public function setEtape($etape)
    {
        $this->etape = $etape;

        return $this;
    }

    /**
     * Get etape
     *
     * @return object
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * Set Notes
     *
     * @param integer $notes
     *
     * @return Project
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     * @ORM\PostLoad
     * @return object
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set dateCreation
     *
     * @param \Date $dateCreation
     *
     * @return Project
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \Date
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set datedebutPrevue
     *
     * @param \Date $datedebutPrevue
     *
     * @return Project
     */
    public function setDatedebutPrevue($datedebutPrevue)
    {
        $this->datedebutPrevue = $datedebutPrevue;

        return $this;
    }

    /**
     * Get datedebutPrevue
     *
     * @return \Date
     */
    public function getDatedebutPrevue()
    {
        return $this->datedebutPrevue;
    }

    /**
     * Set datefinPrevue
     *
     * @param \Date $datefinPrevue
     *
     * @return Project
     */
    public function setDatefinPrevue($datefinPrevue)
    {
        $this->datefinPrevue = $datefinPrevue;

        return $this;
    }

    /**
     * Get datefinPrevue
     *
     * @return \Date
     */
    public function getDatefinPrevue()
    {
        return $this->datefinPrevue;
    }

    /**
     * Set datedebutReelle
     *
     * @param \Date $datedebutReelle
     *
     * @return Project
     */
    public function setDatedebutReelle($datedebutReelle)
    {
        $this->datedebutReelle = $datedebutReelle;

        return $this;
    }

    /**
     * Get datedebutReelle
     *
     * @return \Date
     */
    public function getDatedebutReelle()
    {
        return $this->datedebutReelle;
    }

    /**
     * Set datefinReelle
     *
     * @param \Date $datefinReelle
     *
     * @return Project
     */
    public function setDatefinReelle($datefinReelle)
    {
        $this->datefinReelle = $datefinReelle;

        return $this;
    }

    /**
     * Get datefinReelle
     *
     * @return \Date
     */
    public function getDatefinReelle()
    {
        return $this->datefinReelle;
    }

    /**
     * Set statut
     *
     * @param integer $statut
     *
     * @return Project
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

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
     * Set statuts
     *
     * @param integer $statuts
     *
     * @return Project
     */
    public function setStatuts($statuts)
    {
        $this->statuts = $statuts;

        return $this;
    }

    /**
     * Get statuts
     *
     * @return int
     */
    public function getStatuts()
    {
        return $this->statuts;
    }

    /**
     * Set idLeader
     *
     * @param integer $idLeader
     *
     * @return Project
     */
    public function setIdLeader($idLeader)
    {
        $this->idLeader = $idLeader;

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
     * Set Leaders
     *
     * @param integer $leaders
     *
     * @return Project
     */
    public function setLeaders($leaders)
    {
        $this->leaders = $leaders;

        return $this;
    }

    /**
     * Get leaders
     *
     * @return object
     */
    public function getLeaders()
    {
        return $this->leaders;
    }

    /**
     * Set joursHommesPrevus
     *
     * @param integer $joursHommesPrevus
     *
     * @return Project
     */
    public function setJoursHommesPrevus($joursHommesPrevus)
    {
        $this->joursHommesPrevus = $joursHommesPrevus ? $joursHommesPrevus : 0;

        return $this;
    }

    /**
     * Get joursHommesPrevus
     *
     * @return int
     */
    public function getJoursHommesPrevus()
    {
        return $this->joursHommesPrevus;
    }

    /**
     * Set joursHommesReels
     *
     * @param integer $joursHommesReels
     *
     * @return Project
     */
    public function setJoursHommesReels($joursHommesReels)
    {
        $this->joursHommesReels = $joursHommesReels ? $joursHommesReels : 0;

        return $this;
    }

    /**
     * Get joursHommesReels
     *
     * @return int
     */
    public function getJoursHommesReels()
    {
        return $this->joursHommesReels;
    }

    /**
     * Set modeAcces
     *
     * @param integer $modeAcces
     *
     * @return Project
     */
    public function setModeAcces($modeAcces)
    {
        $this->modeAcces = $modeAcces;

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
     * Set contact
     *
     * @param integer $contact
     *
     * @return Project
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return int
     */
    public function getContact()
    {
        return $this->contact;
    }
}

