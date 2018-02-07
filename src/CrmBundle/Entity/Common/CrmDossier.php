<?php

namespace CrmBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmDossier
 *
 * @ORM\Table(name="crm_dossier")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\Common\CrmDossierRepository")
 * @ProjectBundle\Annotation\Label\LabelClass
 * @ProjectBundle\Annotation\Date\DateClass
 */
class CrmDossier
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
     * @ORM\Column(name="idEntiteJ", type="integer", length=11)
     */
    private $idEntiteJ;

    /**
    * entitej object
    */
    private $entite;

    /**
     * @var int
     *
     * @ORM\Column(name="idCycle", type="integer", length=11)
     */
    private $idCycle;

    /**
     * @var int
     */
    private $cycle;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=20)
     */
    private $code = '';

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
     * @ORM\Column(name="icone", type="string", length=80)
     */
    private $icone = '';

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=10)
     */
    private $reference  = '';

    /**
     * @var int
     *
     * @ORM\Column(name="idMarketSegment", type="integer", length=11)
     */
    private $idMarketSegment = 0;

    /**
     * @var string
     */
    private $descriptionPerimetres;

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre0", type="text")
     */
    private $descriptionPerimetre0;

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre1", type="text")
     */
    private $descriptionPerimetre1;

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre2", type="text")
     */
    private $descriptionPerimetre2;

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre3", type="text")
     */
    private $descriptionPerimetre3;

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre4", type="text")
     */
    private $descriptionPerimetre4;

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre5", type="text")
     */
    private $descriptionPerimetre5;

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre6", type="text")
     */
    private $descriptionPerimetre6;

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre7", type="text")
     */
    private $descriptionPerimetre7;

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre8", type="text")
     */
    private $descriptionPerimetre8;

    /**
     * @var string
     *
     * @ORM\Column(name="description_perimetre9", type="text")
     */
    private $descriptionPerimetre9;

    /**
     * @var int
     *
     * @ORM\Column(name="idCreateur", type="integer", length=11)
     */
    private $idCreateur;

    /**
     * @var int
     */
    private $contact;

    /**
     * @var object
     */
    private $user;

    /**
     * @var \Date
     *
     * @ORM\Column(name="dateCreation", type="date")
     */
    private $dateCreation;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datedebut_prevue", type="date")
     */
    private $datedebutPrevue;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datefin_prevue", type="date")
     */
    private $datefinPrevue;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datedebut_reelle", type="date")
     */
    private $datedebutReelle;

    /**
     * @var \Date
     *
     * @ORM\Column(name="datefin_reelle", type="date")
     */
    private $datefinReelle;

    /**
     * @var int
     *
     * @ORM\Column(name="statut", type="integer", length=11)
     */
    private $statut = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idOwner", type="integer", length=11)
     */
    private $idOwner;

    /**
     * @var int
     *
     * @ORM\Column(name="idWatcher", type="integer", length=11)
     */
    private $idWatcher;

    /**
     * @var int
     *
     * @ORM\Column(name="modeAcces", type="integer", length=11)
     */
    private $modeAcces = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="Rankingprevu", type="integer", length=11)
     */
    private $Rakingprevu = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="Rankingactuel", type="integer", length=11)
     */
    private $Rakingactuel = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="descriptionResultat", type="text")
     */
    private $descriptionResultat = '';

    /**
     * @var int
     *
     * @ORM\Column(name="idResultat", type="integer", length=11)
     */
    private $idResultat = 0;

    /**
     * @var object
     *
     * @ORM\OneToMany(targetEntity="CrmEtapes", mappedBy="crm", fetch="EAGER")
     */
    private $etapes;

    /**
     * @var object
     */
    private $docRecus;

    /**
     * @var object
     */
    private $docEnvoyes;


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
     * Set code
     *
     * @param string $idEntiteJ
     *
     * @return CrmDossier
     */
    public function setIdEntiteJ($idEntiteJ)
    {
        $this->idEntiteJ = $idEntiteJ ? $idEntiteJ : $this->idEntiteJ;

        return $this;
    }

    /**
     * Get idEntiteJ
     *
     * @return string
     */
    public function getIdEntiteJ()
    {
        return $this->idEntiteJ;
    }

    /**
     * Set code
     *
     * @param string $entite
     *
     * @return CrmDossier
     */
    public function setEntite($entite)
    {
        $this->entite = $entite;

        return $this;
    }

    /**
     * Get entite
     *
     * @return string
     */
    public function getEntite()
    {
        return $this->entite;
    }

    /**
     * Set code
     *
     * @param string $idCycle
     *
     * @return CrmDossier
     */
    public function setIdCycle($idCycle)
    {
        $this->idCycle = $idCycle ? $idCycle : $this->idCycle;

        return $this;
    }

    /**
     * Get idCycle
     *
     * @return string
     */
    public function getIdCycle()
    {
        return $this->idCycle;
    }

    /**
     * Set cycle
     *
     * @param string $cycle
     *
     * @return CrmDossier
     */
    public function setCycle(\CrmBundle\Entity\Back\CrmParamCycles $cycle)
    {
        $this->cycle = $cycle;

        return $this;
    }

    /**
     * Get cycle
     *
     * @return string
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return CrmDossier
     */
    public function setCode($code)
    {
        $this->code = $code ? $code: $this->code;

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
     *
     * @param string $label
     * @ORM\postLoad
     * @return CrmDossier
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     * @ORM\postLoad
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
     * @return CrmDossier
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
     * @return CrmDossier
     */
    public function setlib1($lib1)
    {
        $this->lib1 = $lib1 ? $lib1 : $this->lib1;

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
     * @return CrmDossier
     */
    public function setlib2($lib2)
    {
        $this->lib2 = $lib2 ? $lib2 : $this->lib2;

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
     * @return CrmDossier
     */
    public function setlib3($lib3)
    {
        $this->lib3 = $lib3 ? $lib3 : $this->lib3;

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
     * @return CrmDossier
     */
    public function setlib4($lib4)
    {
        $this->lib4 = $lib4 ? $lib4 : $this->lib4;

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
     * @return CrmDossier
     */
    public function setlib5($lib5)
    {
        $this->lib5 = $lib5 ? $lib5 : $this->lib5;

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
     * @return CrmDossier
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
     * @return CrmDossier
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
     * @return CrmDossier
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
     * @return CrmDossier
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
     * @return CrmDossier
     */
    public function setIcone($icone)
    {
        $this->icone = $icone ? $icone : $this->icone;

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
     * @return CrmDossier
     */
    public function setReference($reference)
    {
        $this->reference = $reference ? $reference : $this->reference;

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
     * Set  idMarketSegment
     *
     * @param string $idMarketSegment
     *
     * @return CrmDossier
     */
    public function setIdMarketSegment($idMarketSegment)
    {
        $this->idMarketSegment = $idMarketSegment ? $idMarketSegment : $this->idMarketSegment;

        return $this;
    }

    /**
     * Get idMarketSegment
     *
     * @return string
     */
    public function getIdMarketSegment()
    {
        return $this->idMarketSegment;
    }

    /**
     * Set descriptionPerimetre
     *
     * @param string $descriptionPerimetre
     *
     * @return CrmDossier
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
     * @return CrmDossier
     */
    public function setDescriptionPerimetre0($descriptionPerimetre0)
    {
        $this->descriptionPerimetre0 = $descriptionPerimetre0;

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
     * @return CrmDossier
     */
    public function setDescriptionPerimetre1($descriptionPerimetre1)
    {
        $this->descriptionPerimetre1 = $descriptionPerimetre1;

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
     * @return CrmDossier
     */
    public function setDescriptionPerimetre2($descriptionPerimetre2)
    {
        $this->descriptionPerimetre2 = $descriptionPerimetre2;

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
     * @return CrmDossier
     */
    public function setDescriptionPerimetre3($descriptionPerimetre3)
    {
        $this->descriptionPerimetre3 = $descriptionPerimetre3;

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
     * @return CrmDossier
     */
    public function setDescriptionPerimetre4($descriptionPerimetre4)
    {
        $this->descriptionPerimetre4 = $descriptionPerimetre4;

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
     * @return CrmDossier
     */
    public function setDescriptionPerimetre5($descriptionPerimetre5)
    {
        $this->descriptionPerimetre5 = $descriptionPerimetre5;

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
     * @return CrmDossier
     */
    public function setDescriptionPerimetre6($descriptionPerimetre6)
    {
        $this->descriptionPerimetre6 = $descriptionPerimetre6;

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
     * @return CrmDossier
     */
    public function setDescriptionPerimetre7($descriptionPerimetre7)
    {
        $this->descriptionPerimetre7 = $descriptionPerimetre7;

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
     * @return CrmDossier
     */
    public function setDescriptionPerimetre8($descriptionPerimetre8)
    {
        $this->descriptionPerimetre8 = $descriptionPerimetre8;

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
     * @return CrmDossier
     */
    public function setDescriptionPerimetre9($descriptionPerimetre9)
    {
        $this->descriptionPerimetre9 = $descriptionPerimetre9;

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
     * @return CrmDossier
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
     * @return CrmDossier
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
     * @return CrmDossier
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
     * Set dateCreation
     *
     * @param \Date $dateCreation
     *
     * @return CrmDossier
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
     * @return CrmDossier
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
     * @return CrmDossier
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
     * @return CrmDossier
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
     * @return CrmDossier
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
     * @return CrmDossier
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
     * Set idOwner
     *
     * @param integer $idOwner
     *
     * @return CrmDossier
     */
    public function setIdOwner($idOwner)
    {
        $this->idOwner = $idOwner;

        return $this;
    }

    /**
     * Get idOwner
     *
     * @return int
     */
    public function getIdOwner()
    {
        return $this->idOwner;
    }

    /**
     * Set idWatcher
     *
     * @param integer $idWatcher
     *
     * @return CrmDossier
     */
    public function setIdWatcher($idWatcher)
    {
        $this->idWatcher = $idWatcher;

        return $this;
    }

    /**
     * Get idWatcher
     *
     * @return int
     */
    public function getIdWatcher()
    {
        return $this->idWatcher;
    }

    /**
     * Set Rakingprevu
     *
     * @param integer $Rakingprevu
     *
     * @return CrmDossier
     */
    public function setRakingprevu($Rakingprevu)
    {
        $this->Rakingprevu = $Rakingprevu ? $Rakingprevu : $this->Rakingprevu;

        return $this;
    }

    /**
     * Get Rakingprevu
     *
     * @return int
     */
    public function getRakingprevu()
    {
        return $this->Rakingprevu;
    }

    /**
     * Set Rakingactuel
     *
     * @param integer $Rakingactuel
     *
     * @return CrmDossier
     */
    public function setRakingactuel($Rakingactuel)
    {
        $this->Rakingactuel = $Rakingactuel ? $Rakingactuel : $this->Rakingactuel;

        return $this;
    }

    /**
     * Get Rakingactuel
     *
     * @return int
     */
    public function getRakingactuel()
    {
        return $this->Rakingactuel;
    }

    /**
     * Set descriptionResultat
     *
     * @param integer $descriptionResultat
     *
     * @return CrmDossier
     */
    public function setDescriptionResultat($descriptionResultat)
    {
        $this->descriptionResultat = $descriptionResultat ? $descriptionResultat : $this->descriptionResultat;

        return $this;
    }

    /**
     * Get descriptionResultat
     *
     * @return int
     */
    public function getDescriptionResultat()
    {
        return $this->descriptionResultat;
    }

    /**
     * Set idResultat
     *
     * @param integer $idResultat
     *
     * @return CrmDossier
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
     * Set modeAcces
     *
     * @param integer $modeAcces
     *
     * @return CrmDossier
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
     * Set etapes
     *
     * @param object $etapes
     *
     * @return CrmDossier
     */
    public function setEtapes($etapes)
    {
        $this->etapes = $etapes;

        return $this;
    }

    /**
     * Get etapes
     *
     * @return object
     */
    public function getEtapes()
    {
        return $this->etapes;
    }

    /**
     * Set etapes
     *
     * @param object $contact
     *
     * @return CrmDossier
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get etapes
     *
     * @return object
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set etapes
     *
     * @param object $user
     *
     * @return CrmDossier
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get etapes
     *
     * @return object
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set docRecus
     *
     * @param datetime $docRecus
     *
     * @return CrmDossier
     */
    public function setDocRecus($docRecus)
    {
        $this->docRecus = $docRecus;

        return $this;
    }

    /**
     * Get docRecus
     *
     * @return object
     */
    public function getDocRecus()
    {
        return $this->docRecus;
    }

     /**
     * Set docEnvoyes
     *
     * @param datetime $docEnvoyes
     *
     * @return CrmDossier
     */
    public function setDocEnvoyes($docEnvoyes)
    {
        $this->docEnvoyes = $docEnvoyes;

        return $this;
    }

    /**
     * Get docEnvoyes
     *
     * @return object
     */
    public function getDocEnvoyes()
    {
        return $this->docEnvoyes;
    }
}

