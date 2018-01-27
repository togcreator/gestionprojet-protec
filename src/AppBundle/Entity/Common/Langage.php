<?php

namespace AppBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;

/**
 * langage
 *
 * @ORM\Table(name="langage")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Common\langageRepository")
 */
class Langage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Common\Users", mappedBy="idLangage")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="iso", type="string", length=60)
     */
    private $iso;

    /**
     * @var string
     *
     * @ORM\Column(name="labels", type="string", length=60)
     */
    private $labels;

    /**
     * @var string
     *
     * @ORM\Column(name="abr", type="string", length=60)
     */
    private $abr;


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
     * Set iso
     *
     * @param string $iso
     *
     * @return langage
     */
    public function setIso($iso)
    {
        $this->iso = $iso;

        return $this;
    }

    /**
     * Get iso
     *
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * Set labels
     *
     * @param string $labels
     *
     * @return langage
     */
    public function setLabels($labels)
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * Get labels
     *
     * @return string
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * Set abr
     *
     * @param string $abr
     *
     * @return langage
     */
    public function setAbr($abr)
    {
        $this->abr = $abr;

        return $this;
    }

    /**
     * Get abr
     *
     * @return string
     */
    public function getAbr()
    {
        return $this->abr;
    }
}

