<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * UserClient
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UsersBundle\Repository\UserClientRepository")
 */
class UserClient
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="IDNatureUser", type="integer")
     */
    private $iDNatureUser;

    /**
     * @var int
     *
     * @ORM\Column(name="IDGroupe", type="integer")
     */
    private $iDGroupe;

    /**
     * @var int
     *
     * @ORM\Column(name="IDCompte", type="integer")
     */
    private $iDCompte;

    /**
     * @var string
     *
     * @ORM\Column(name="Code", type="string", length=20)
     */
    private $code;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var int
     *
     * @ORM\Column(name="IDGenre", type="integer")
     */
    private $iDGenre;

    /**
     * @var string
     *
     * @ORM\Column(name="Login", type="string")
     */
    private $login = '';

    /**
     * @var string
     *
     * @ORM\Column(name="NomUser", type="string", length=200)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=100)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="Adr1", type="string", length=200)
     */
    private $adr1 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Adr2", type="string", length=100)
     */
    private $adr2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="CP", type="string", length=10)
     */
    private $cp = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Ville", type="string", length=80)
     */
    private $ville = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Pays", type="string", length=10)
     */
    private $pays = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Telephone", type="string", length=20)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="Fax", type="string", length=20)
     */
    private $fax = '';

    /**
     * @var string
     *
     * @ORM\Column(name="GSM", type="string", length=20)
     */
    private $gsm = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=100)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Photo", type="text")
     */
    private $photo = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Langage", type="integer", length=11)
     */
    private $langage;

    /**
     * @var string
     *
     * @ORM\Column(name="Actif_status", type="integer", length=10)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="origine", type="string", length=20)
     */
    private $origine = '';

    /**
     * @var string
     *
     * @ORM\Column(name="idOrigine", type="integer", length=11)
     */
    private $idOrigine = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="Version", type="integer", length=11)
     */
    private $version = 0;

    /**
     * @ORM\OneToMany(targetEntity="MailBundle\Entity\MailPeople", mappedBy="userFrom")
     */
    private $mailPeopleFrom;

    /**
     * @ORM\OneToMany(targetEntity="MailBundle\Entity\MailPeople", mappedBy="userTo")
     */
    private $mailPeopleTo;

    /**
     * @ORM\OneToMany(targetEntity="MailBundle\Entity\Mail", mappedBy="user")
     */
    private $mails;

    /**
     * @ORM\ManyToOne(targetEntity="Users", fetch="EAGER")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var integer
     */
    private $iDBusinessUnit;

    /**
     * @var integer
     */
    private $iDRelationFonctionnelle;

    /**
     * @var integer
     */
    private $r_bu_entitej;

    /**
     * @var integer
     */
    private $iDEntite;

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
     * Set id
     *
     * @param integer $id
     *
     * @return UserClient
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set iDNatureUser
     *
     * @param integer $iDNatureUser
     *
     * @return UserClient
     */
    public function setIDNatureUser($iDNatureUser)
    {
        $this->iDNatureUser = $iDNatureUser;

        return $this;
    }

    /**
     * Get iDNatureUser
     *
     * @return int
     */
    public function getIDNatureUser()
    {
        return $this->iDNatureUser;
    }

    /**
     * Set iDGroupe
     *
     * @param integer $iDGroupe
     *
     * @return UserClient
     */
    public function setIDGroupe($iDGroupe)
    {
        $this->iDGroupe = $iDGroupe;

        return $this;
    }

    /**
     * Get iDGroupe
     *
     * @return int
     */
    public function getIDGroupe()
    {
        return $this->iDGroupe;
    }

    /**
     * Set iDCompte
     *
     * @param integer $iDCompte
     *
     * @return UserClient
     */
    public function setIDCompte($iDCompte)
    {
        $this->iDCompte = $iDCompte;

        return $this;
    }

    /**
     * Get iDCompte
     *
     * @return int
     */
    public function getIDCompte()
    {
        return $this->iDCompte;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return UserClient
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return UserClient
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
     * Set iDGenre
     *
     * @param integer $iDGenre
     *
     * @return UserClient
     */
    public function setIDGenre($iDGenre)
    {
        $this->iDGenre = $iDGenre;

        return $this;
    }

    /**
     * Get iDGenre
     *
     * @return int
     */
    public function getIDGenre()
    {
        return $this->iDGenre;
    }

    /**
     * Set adr1
     *
     * @param string $adr1
     *
     * @return UserClient
     */
    public function setAdr1($adr1)
    {
        $this->adr1 = $adr1 ? $adr1 : $this->adr1;

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
     * @return UserClient
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
     * @return UserClient
     */
    public function setCp($cp)
    {
        $this->cp = $cp ? $cp : $this->cp;

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
     * @return UserClient
     */
    public function setVille($ville)
    {
        $this->ville = $ville ? $ville : $this->ville;

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
     * @return UserClient
     */
    public function setPays($pays)
    {
        $this->pays = $pays ? $pays : $this->pays;

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
     * Set telephone
     *
     * @param string $telephone
     *
     * @return UserClient
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return UserClient
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
     * Set gsm
     *
     * @param string $gsm
     *
     * @return UserClient
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
     * Set email
     *
     * @param string $email
     *
     * @return UserClient
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
     * Set photo
     *
     * @param string $photo
     *
     * @return UserClient
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo ? $photo : $this->photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set langage
     *
     * @param integer $langage
     *
     * @return UserClient
     */
    public function setLangage($langage)
    {
        $this->langage = $langage;

        return $this;
    }

    /**
     * Get langage
     *
     * @return integer
     */
    public function getLangage()
    {
        return $this->langage;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return UserClient
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set origine
     *
     * @param string $origine
     *
     * @return UserClient
     */
    public function setOrigine($origine)
    {
        $this->origine = $origine ? $origine : $this->origine;

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
     * @return UserClient
     */
    public function setIdOrigine($idOrigine)
    {
        $this->idOrigine = $idOrigine;

        return $this;
    }

    /**
     * Get idOrigine
     *
     * @return integer
     */
    public function getIdOrigine()
    {
        return $this->idOrigine;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return UserClient
     */
    public function setVersion($version)
    {
        $this->version = $version ? $version : $this->version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set user
     *
     * @param \UsersBundle\Entity\Users $user
     *
     * @return UserClient
     */
    public function setUser($user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UsersBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return UserClient
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return UserClient
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set login
     *
     * @param string $firstname
     *
     * @return UserClient
     */
    public function setLogin($login)
    {
        $this->login = $login ? $login : $this->login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set iDBusinessUnit
     *
     * @param string $iDBusinessUnit
     *
     * @return UserClient
     */
    public function setIDBusinessUnit($iDBusinessUnit)
    {
        $this->iDBusinessUnit = $iDBusinessUnit;

        return $this;
    }

    /**
     * Get iDBusinessUnit
     *
     * @return string
     */
    public function getIDBusinessUnit()
    {
        return $this->iDBusinessUnit;
    }

    /**
     * Set iDRelationFonctionnelle
     *
     * @param string $iDRelationFonctionnelle
     *
     * @return UserClient
     */
    public function setIDRelationFonctionnelle($iDRelationFonctionnelle)
    {
        $this->iDRelationFonctionnelle = $iDRelationFonctionnelle;

        return $this;
    }

    /**
     * Get r_bu_entitej
     *
     * @return string
     */
    public function getIDRelationFonctionnelle()
    {
        return $this->iDRelationFonctionnelle;
    }

    /**
     * Set r_bu_entitej
     *
     * @param string $r_bu_entitej
     *
     * @return UserClient
     */
    public function setRbuentitej($r_bu_entitej)
    {
        $this->r_bu_entitej = $r_bu_entitej;

        return $this;
    }

    /**
     * Get r_bu_entitej
     *
     * @return string
     */
    public function getRbuentitej()
    {
        return $this->r_bu_entitej;
    }

    /**
     * Set iDEntite
     *
     * @param string $iDEntite
     *
     * @return UserClient
     */
    public function setIDEntite($iDEntite)
    {
        $this->iDEntite = $iDEntite;

        return $this;
    }

    /**
     * Get iDEntite
     *
     * @return string
     */
    public function getIDEntite()
    {
        return $this->iDEntite;
    }

    /**
    * Override toString
    *
    * @return string
    */
    public function __toString() {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Add mailPeopleFrom
     *
     * @param \MailBundle\Entity\MailPeople $mailPeopleFrom
     *
     * @return Users
     */
    public function addMailPeopleFrom(\MailBundle\Entity\MailPeople $mailPeopleFrom)
    {
        $this->mailPeopleFrom[] = $mailPeopleFrom;

        return $this;
    }

    /**
     * Remove mailPeopleFrom
     *
     * @param \MailBundle\Entity\MailPeople $mailPeopleFrom
     */
    public function removeMailPeopleFrom(\MailBundle\Entity\MailPeople $mailPeopleFrom)
    {
        $this->mailPeopleFrom->removeElement($mailPeopleFrom);
    }

    /**
     * Get mailPeopleFrom
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMailPeopleFrom()
    {
        return $this->mailPeopleFrom;
    }

    /**
     * Add mailPeopleTo
     *
     * @param \MailBundle\Entity\MailPeople $mailPeopleTo
     *
     * @return Users
     */
    public function addMailPeopleTo(\MailBundle\Entity\MailPeople $mailPeopleTo)
    {
        $this->mailPeopleTo[] = $mailPeopleTo;

        return $this;
    }

    /**
     * Remove mailPeopleTo
     *
     * @param \MailBundle\Entity\MailPeople $mailPeopleTo
     */
    public function removeMailPeopleTo(\MailBundle\Entity\MailPeople $mailPeopleTo)
    {
        $this->mailPeopleTo->removeElement($mailPeopleTo);
    }

    /**
     * Get mailPeopleTo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMailPeopleTo()
    {
        return $this->mailPeopleTo;
    }

    /**
     * Add mail
     *
     * @param \MailBundle\Entity\Mail $mail
     *
     * @return Users
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

    /* test role */
    public function isRole ($role) {
        return in_array($role, $this->roles);
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mailPeopleFrom = new \Doctrine\Common\Collections\ArrayCollection();
        $this->mailPeopleTo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->mails = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
