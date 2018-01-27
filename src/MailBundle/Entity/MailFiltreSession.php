<?php

namespace MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailFiltreSession
 *
 * @ORM\Table(name="mail_filtre_session")
 * @ORM\Entity(repositoryClass="MailBundle\Repository\MailFiltreSessionRepository")
 */
class MailFiltreSession
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
     * @ORM\Column(name="idUser", type="integer")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="filtreMc", type="string", length=255, nullable=false)
     */
    private $filtreMc;

    /**
     * @var string
     *
     * @ORM\Column(name="filtrePeriode", type="string", length=255, nullable=true)
     */
    private $filtrePeriode;

    /**
     * @var string
     *
     * @ORM\Column(name="filtreTbox", type="string", length=255, nullable=true)
     */
    private $filtreTbox;

    /**
     * @var string
     *
     * @ORM\Column(name="filtrePriorite", type="string", length=255, nullable=true)
     */
    private $filtrePriorite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFiltre", type="datetime")
     */
    private $dateFiltre;

    /**
     * @var string
     *
     * @ORM\Column(name="nomFiltre", type="string", length=255, nullable=false)
     */
    private $nomFiltre;


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
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return MailFiltreSession
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
     * Set filtreMc
     *
     * @param string $filtreMc
     *
     * @return MailFiltreSession
     */
    public function setFiltreMc($filtreMc)
    {
        $this->filtreMc = $filtreMc;

        return $this;
    }

    /**
     * Get filtreMc
     *
     * @return string
     */
    public function getFiltreMc()
    {
        return $this->filtreMc;
    }

    /**
     * Set filtrePeriode
     *
     * @param string $filtrePeriode
     *
     * @return MailFiltreSession
     */
    public function setFiltrePeriode($filtrePeriode)
    {
        $this->filtrePeriode = $filtrePeriode;

        return $this;
    }

    /**
     * Get filtrePeriode
     *
     * @return string
     */
    public function getFiltrePeriode()
    {
        return $this->filtrePeriode;
    }

    /**
     * Set filtreTbox
     *
     * @param string $filtreTbox
     *
     * @return MailFiltreSession
     */
    public function setFiltreTbox($filtreTbox)
    {
        $this->filtreTbox = $filtreTbox;

        return $this;
    }

    /**
     * Get filtreTbox
     *
     * @return string
     */
    public function getFiltreTbox()
    {
        return $this->filtreTbox;
    }

    /**
     * Set filtrePriorite
     *
     * @param string $filtrePriorite
     *
     * @return MailFiltreSession
     */
    public function setFiltrePriorite($filtrePriorite)
    {
        $this->filtrePriorite = $filtrePriorite;

        return $this;
    }

    /**
     * Get filtrePriorite
     *
     * @return string
     */
    public function getFiltrePriorite()
    {
        return $this->filtrePriorite;
    }

    /**
     * Set dateFiltre
     *
     * @param \DateTime $dateFiltre
     *
     * @return MailFiltreSession
     */
    public function setDateFiltre($dateFiltre)
    {
        $this->dateFiltre = $dateFiltre;

        return $this;
    }

    /**
     * Get dateFiltre
     *
     * @return \DateTime
     */
    public function getDateFiltre()
    {
        return $this->dateFiltre;
    }

    /**
     * Set nomFiltre
     *
     * @param string $nomFiltre
     *
     * @return MailFiltreSession
     */
    public function setNomFiltre($nomFiltre)
    {
        $this->nomFiltre = $nomFiltre;

        return $this;
    }

    /**
     * Get filtrePriorite
     *
     * @return string
     */
    public function getNomFiltre()
    {
        return $this->nomFiltre;
    }
}
