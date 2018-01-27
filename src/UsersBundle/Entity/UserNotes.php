<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserNotes
 *
 * @ORM\Table(name="user_notes")
 * @ORM\Entity(repositoryClass="UsersBundle\Repository\UserNotesRepository")
 */
class UserNotes
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
     * @ORM\Column(name="idUserconcerne", type="integer")
     */
    private $idUserconcerne;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=50)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="text")
     */
    private $objet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

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
     * Set idUserconcerne
     *
     * @param integer $idUserconcerne
     *
     * @return UserNotes
     */
    public function setIdUserconcerne($idUserconcerne)
    {
        $this->idUserconcerne = $idUserconcerne;

        return $this;
    }

    /**
     * Get idUserconcerne
     *
     * @return int
     */
    public function getIdUserconcerne()
    {
        return $this->idUserconcerne;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return UserNotes
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

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
     * Set titre
     *
     * @param string $titre
     *
     * @return UserNotes
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set objet
     *
     * @param string $objet
     *
     * @return UserNotes
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return UserNotes
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return UserNotes
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

