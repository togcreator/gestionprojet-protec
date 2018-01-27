<?php

namespace ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CPFra
 *
 * @ORM\Table(name="cpfra")
 * @ORM\Entity(repositoryClass="Protec\ClientBundle\Repository\CPFraRepository")
 */
class CPFra
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="insee", type="string", length=255)
     */
    private $insee;

    /**
     * @var int
     *
     * @ORM\Column(name="secteurGeo", type="integer")
     */
    private $secteurGeo;

    /**
     * @var float
     *
     * @ORM\Column(name="lat", type="float")
     */
    private $lat;

    /**
     * @var float
     *
     * @ORM\Column(name="lng", type="float", length=255)
     */
    private $lng;

    /**
     * @var float
     *
     * @ORM\Column(name="eloignement", type="float")
     */
    private $eloignement;

    /**
     * @var int
     *
     * @ORM\Column(name="altitude", type="integer")
     */
    private $altitude;

    /**
     * @var int
     *
     * @ORM\Column(name="population", type="integer")
     */
    private $population;

    /**
     * @var float
     *
     * @ORM\Column(name="surface", type="float")
     */
    private $surface;


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
     * @param string $code
     *
     * @return CPFra
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
     * Set ville
     *
     * @param string $ville
     *
     * @return CPFra
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
     * Set insee
     *
     * @param string $insee
     *
     * @return CPFra
     */
    public function setInsee($insee)
    {
        $this->insee = $insee;

        return $this;
    }

    /**
     * Get insee
     *
     * @return string
     */
    public function getInsee()
    {
        return $this->insee;
    }

    /**
     * Set secteurGeo
     *
     * @param integer $secteurGeo
     *
     * @return CPFra
     */
    public function setSecteurGeo($secteurGeo)
    {
        $this->secteurGeo = $secteurGeo;

        return $this;
    }

    /**
     * Get secteurGeo
     *
     * @return int
     */
    public function getSecteurGeo()
    {
        return $this->secteurGeo;
    }

    /**
     * Set lat
     *
     * @param float $lat
     *
     * @return CPFra
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param float $lng
     *
     * @return CPFra
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set eloignement
     *
     * @param float $eloignement
     *
     * @return CPFra
     */
    public function setEloignement($eloignement)
    {
        $this->eloignement = $eloignement;

        return $this;
    }

    /**
     * Get eloignement
     *
     * @return float
     */
    public function getEloignement()
    {
        return $this->eloignement;
    }

    /**
     * Set altitude
     *
     * @param integer $altitude
     *
     * @return CPFra
     */
    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;

        return $this;
    }

    /**
     * Get altitude
     *
     * @return int
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * Set population
     *
     * @param integer $population
     *
     * @return CPFra
     */
    public function setPopulation($population)
    {
        $this->population = $population;

        return $this;
    }

    /**
     * Get population
     *
     * @return int
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * Set surface
     *
     * @param float $surface
     *
     * @return CPFra
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * Get surface
     *
     * @return float
     */
    public function getSurface()
    {
        return $this->surface;
    }
}

