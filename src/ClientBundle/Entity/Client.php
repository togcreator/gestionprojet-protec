<?php

namespace ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="entite_juridique")
 * @ORM\Entity(repositoryClass="ClientBundle\Repository\ClientRepository")
 * @ProjectBundle\Annotation\Date\DateClass
 */
class Client
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDEntite", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idGroupe", type="integer")
     */
    private $idGroupe = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="raisonSociale", type="string", length=255)
     */
    private $raisonSociale;

    /**
     * @var string
     *
     * @ORM\Column(name="adr1", type="string", length=255)
     */
    private $adr1;

    /**
     * @var string
     *
     * @ORM\Column(name="adr2", type="string", length=255)
     */
    private $adr2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=255)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="gsm", type="string", length=255)
     */
    private $gsm = '';

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255)
     */
    private $fax = '';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="idFormeJuridique", type="integer")
     */
    private $idFormeJuridique = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=255)
     */
    private $siret = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tvaIntraCommunautaire", type="string", length=255)
     */
    private $tvaIntraCommunautaire = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ape", type="string", length=255)
     */
    private $ape = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tranche_effectif", type="string", length=255)
     */
    private $trancheEffectif = '';

    /**
     * @var string
     *
     * @ORM\Column(name="code_cegid", type="string", length=255)
     */
    private $codeCegid = '';

    /**
     * @var string
     *
     * @ORM\Column(name="code_sage", type="string", length=255)
     */
    private $codeSage = '';

    /**
     * @var string
     *
     * @ORM\Column(name="code_exact", type="string", length=255)
     */
    private $codeExact = '';

    /**
     * @var string
     *
     * @ORM\Column(name="origine", type="string", length=255)
     */
    private $origine = '';

    /**
     * @var int
     *
     * @ORM\Column(name="idOrigine", type="integer")
     */
    private $idOrigine = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser4Creation", type="integer")
     */
    private $idUser4Creation;

    /**
     * @var int
     *
     * @ORM\Column(name="idTypePaiement", type="integer")
     */
    private $idTypePaiement = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="idTypeFacturation", type="integer")
     */
    private $idTypeFacturation = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="echeance", type="integer")
     */
    private $echeance = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="siteweb", type="string", length=255)
     */
    private $siteweb = '';

    /**
     * @var int
     *
     * @ORM\Column(name="version", type="integer")
     */
    private $version = 1;

    /**
     *
     * @ORM\Column(name="logo", type="mediumblob")
     */
    private $logo = '';

    /**
     * @ORM\OneToMany(targetEntity="MailBundle\Entity\Mail", mappedBy="entiteJuridique")
     */
    private $mails;

    /**
    * var type
    */
    private $type;


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
     * Set idGroupe
     *
     * @param integer $idGroupe
     *
     * @return Client
     */
    public function setIdGroupe($idGroupe)
    {
        $this->idGroupe = $idGroupe ? $idGroupe : $this->idGroupe;

        return $this;
    }

    /**
     * Get idGroupe
     *
     * @return int
     */
    public function getIdGroupe()
    {
        return $this->idGroupe;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Client
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
     * Set raisonSociale
     *
     * @param string $raisonSociale
     *
     * @return Client
     */
    public function setRaisonSociale($raisonSociale)
    {
        $this->raisonSociale = $raisonSociale;

        return $this;
    }

    /**
     * Get raisonSociale
     *
     * @return string
     */
    public function getRaisonSociale()
    {
        return $this->raisonSociale;
    }

    /**
     * Set adr1
     *
     * @param string $adr1
     *
     * @return Client
     */
    public function setAdr1($adr1)
    {
        $this->adr1 = $adr1;

        return $this;
    }

    /**
     * Get adr1
     *
     * @return string
     */
    public function getAdr1()
    {
        return $this->adr1;
    }

    /**
     * Set adr2
     *
     * @param string $adr2
     *
     * @return Client
     */
    public function setAdr2($adr2)
    {
        $this->adr2 = $adr2 ? $adr2 : $this->adr2;

        return $this;
    }

    /**
     * Get adr2
     *
     * @return string
     */
    public function getAdr2()
    {
        return $this->adr2;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return Client
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Client
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Client
     */
    public function setPays($pays)
    {
        $this->pays = $pays ? $pays: $this->pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Client
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set gsm
     *
     * @param string $gsm
     *
     * @return Client
     */
    public function setGsm($gsm)
    {
        $this->gsm = $gsm ? $gsm : $this->gsm;

        return $this;
    }

    /**
     * Get gsm
     *
     * @return string
     */
    public function getGsm()
    {
        return $this->gsm;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return Client
     */
    public function setFax($fax)
    {
        $this->fax = $fax ? $fax : $this->fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Client
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set idFormeJuridique
     *
     * @param integer $idFormeJuridique
     *
     * @return Client
     */
    public function setIdFormeJuridique($idFormeJuridique)
    {
        $this->idFormeJuridique = $idFormeJuridique ? $idFormeJuridique : $this->idFormeJuridique;

        return $this;
    }

    /**
     * Get idFormeJuridique
     *
     * @return int
     */
    public function getIdFormeJuridique()
    {
        return $this->idFormeJuridique;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Client
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Client
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set siret
     *
     * @param string $siret
     *
     * @return Client
     */
    public function setSiret($siret)
    {
        $this->siret = $siret ? $siret : $this->siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set tvaIntraCommunautaire
     *
     * @param string $tvaIntraCommunautaire
     *
     * @return Client
     */
    public function setTvaIntraCommunautaire($tvaIntraCommunautaire)
    {
        $this->tvaIntraCommunautaire = $tvaIntraCommunautaire ? $tvaIntraCommunautaire : $this->tvaIntraCommunautaire;

        return $this;
    }

    /**
     * Get tvaIntraCommunautaire
     *
     * @return string
     */
    public function getTvaIntraCommunautaire()
    {
        return $this->tvaIntraCommunautaire;
    }

    /**
     * Set ape
     *
     * @param string $ape
     *
     * @return Client
     */
    public function setApe($ape)
    {
        $this->ape = $ape ? $ape : $this->ape;

        return $this;
    }

    /**
     * Get ape
     *
     * @return string
     */
    public function getApe()
    {
        return $this->ape;
    }

    /**
     * Set trancheEffectif
     *
     * @param string $trancheEffectif
     *
     * @return Client
     */
    public function setTrancheEffectif($trancheEffectif)
    {
        $this->trancheEffectif = $trancheEffectif ? $trancheEffectif : $this->trancheEffectif;

        return $this;
    }

    /**
     * Get trancheEffectif
     *
     * @return string
     */
    public function getTrancheEffectif()
    {
        return $this->trancheEffectif;
    }

    /**
     * Set codeCegid
     *
     * @param string $codeCegid
     *
     * @return Client
     */
    public function setCodeCegid($codeCegid)
    {
        $this->codeCegid = $codeCegid ? $codeCegid : $this->codeCegid;

        return $this;
    }

    /**
     * Get codeCegid
     *
     * @return string
     */
    public function getCodeCegid()
    {
        return $this->codeCegid;
    }

    /**
     * Set codeSage
     *
     * @param string $codeSage
     *
     * @return Client
     */
    public function setCodeSage($codeSage)
    {
        $this->codeSage = $codeSage ? $codeSage : $this->codeSage;

        return $this;
    }

    /**
     * Get codeSage
     *
     * @return string
     */
    public function getCodeSage()
    {
        return $this->codeSage;
    }

    /**
     * Set codeExact
     *
     * @param string $codeExact
     *
     * @return Client
     */
    public function setCodeExact($codeExact)
    {
        $this->codeExact = $codeExact ? $codeExact : $this->codeExact;

        return $this;
    }

    /**
     * Get codeExact
     *
     * @return string
     */
    public function getCodeExact()
    {
        return $this->codeExact;
    }

    /**
     * Set origine
     *
     * @param string $origine
     *
     * @return Client
     */
    public function setOrigine($origine)
    {
        $this->origine = $origine ? $origine: $this->origine;

        return $this;
    }

    /**
     * Get origine
     *
     * @return string
     */
    public function getOrigine()
    {
        return $this->origine;
    }

    /**
     * Set idOrigine
     *
     * @param integer $idOrigine
     *
     * @return Client
     */
    public function setIdOrigine($idOrigine)
    {
        $this->idOrigine = $idOrigine ? $idOrigine : $this->idOrigine;

        return $this;
    }

    /**
     * Get idOrigine
     *
     * @return int
     */
    public function getIdOrigine()
    {
        return $this->idOrigine;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Client
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set idUser4Creation
     *
     * @param integer $idUser4Creation
     *
     * @return Client
     */
    public function setIdUser4Creation($idUser4Creation)
    {
        $this->idUser4Creation = $idUser4Creation;

        return $this;
    }

    /**
     * Get idUser4Creation
     *
     * @return int
     */
    public function getIdUser4Creation()
    {
        return $this->idUser4Creation;
    }

    /**
     * Set idTypePaiement
     *
     * @param integer $idTypePaiement
     *
     * @return Client
     */
    public function setIdTypePaiement($idTypePaiement)
    {
        $this->idTypePaiement = $idTypePaiement ? $idTypePaiement : $this->idTypePaiement;

        return $this;
    }

    /**
     * Get idTypePaiement
     *
     * @return int
     */
    public function getIdTypePaiement()
    {
        return $this->idTypePaiement;
    }

    /**
     * Set idTypeFacturation
     *
     * @param integer $idTypeFacturation
     *
     * @return Client
     */
    public function setIdTypeFacturation($idTypeFacturation)
    {
        $this->idTypeFacturation = $idTypeFacturation ? $idTypeFacturation : $this->idTypeFacturation;

        return $this;
    }

    /**
     * Get idTypeFacturation
     *
     * @return int
     */
    public function getIdTypeFacturation()
    {
        return $this->idTypeFacturation;
    }

    /**
     * Set echeance
     *
     * @param integer $echeance
     *
     * @return Client
     */
    public function setEcheance($echeance)
    {
        $this->echeance = $echeance ? $echeance : $this->echeance;

        return $this;
    }

    /**
     * Get echeance
     *
     * @return int
     */
    public function getEcheance()
    {
        return $this->echeance;
    }

    /**
     * Set siteweb
     *
     * @param string $siteweb
     *
     * @return Client
     */
    public function setSiteweb($siteweb)
    {
        $this->siteweb = $siteweb ? $siteweb : $this->siteweb;

        return $this;
    }

    /**
     * Get siteweb
     *
     * @return string
     */
    public function getSiteweb()
    {
        return $this->siteweb;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return Client
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
     * Set type
     *
     * @param integer $type
     *
     * @return Client
     */
    public function setType($type)
    {
        $this->type = $type ? $type: $this->type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set logo
     *
     * @param mediumblob $logo
     *
     * @return Client
     */
    public function setLogo($logo)
    {
        $this->logo = $logo ? $logo : $this->logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return mediumblob
     */
    public function getLogo()
    {
        return $this->logo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mails = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add mail
     *
     * @param \MailBundle\Entity\Mail $mail
     *
     * @return Client
     */
    public function addMail(\MailBundle\Entity\Mail $mail)
    {
        $this->mails[] = $mail;

        return $this;
    }

    /**
     * Remove mail
     *
     * @param \MailBundle\Entity\Mail $mail
     */
    public function removeMail(\MailBundle\Entity\Mail $mail)
    {
        $this->mails->removeElement($mail);
    }

    /**
     * Get mails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMails()
    {
        return $this->mails;
    }
}
