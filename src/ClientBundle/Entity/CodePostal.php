<?php

namespace ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CodePostal
 *
 * @ORM\Table(name="cpfra")
 * @ORM\Entity(repositoryClass="ClientBundle\Repository\CodePostalRepository")
 */
class CodePostal
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
     * @ORM\Column(name="Code", type="string", length=10)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="Ville", type="string", length=100)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="INSEE", type="string", length=10)
     */
    private $iNSEE;

    /**
     * @var int
     *
     * @ORM\Column(name="SecteurGeo", type="integer")
     */
    private $secteurGeo;

    /**
     * @var float
     *
     * @ORM\Column(name="Lat", type="float")
     */
    private $lat;

    /**
     * @var float
     *
     * @ORM\Column(name="Lng", type="float")
     */
    private $lng;

    /**
     * @var float
     *
     * @ORM\Column(name="Eloignement", type="float")
     */
    private $eloignement;

    /**
     * @var float
     *
     * @ORM\Column(name="Altitude", type="float")
     */
    private $altitude;

    /**
     * @var int
     *
     * @ORM\Column(name="Population", type="integer")
     */
    private $population;

    /**
     * @var float
     *
     * @ORM\Column(name="Surface", type="float")
     */
    private $surface;

    /**
     * @var string
     *
     * @ORM\Column(name="Region", type="string", length=50)
     */
    private $region;


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
     * @return CodePostal
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
     * @return CodePostal
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
     * Set iNSEE
     *
     * @param string $iNSEE
     *
     * @return CodePostal
     */
    public function setINSEE($iNSEE)
    {
        $this->iNSEE = $iNSEE;

        return $this;
    }

    /**
     * Get iNSEE
     *
     * @return string
     */
    public function getINSEE()
    {
        return $this->iNSEE;
    }

    /**
     * Set secteurGeo
     *
     * @param integer $secteurGeo
     *
     * @return CodePostal
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
     * @return CodePostal
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
     * @return CodePostal
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
     * @return CodePostal
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
     * @param float $altitude
     *
     * @return CodePostal
     */
    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;

        return $this;
    }

    /**
     * Get altitude
     *
     * @return float
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
     * @return CodePostal
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
     * @return CodePostal
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

    /**
     * Set region
     *
     * @param string $region
     *
     * @return CodePostal
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }
}

