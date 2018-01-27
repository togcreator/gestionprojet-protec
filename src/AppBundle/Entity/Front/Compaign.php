<?php

namespace AppBundle\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compaign
 *
 * @ORM\Table(name="compaign")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Front\CompaignRepository")
 */
class Compaign
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_compaign", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="id")
     *
     * @ORM\Column(name="id_user", type="integer")
     */
    private $idUser;

    /**
     * @var float
     *
     * @ORM\Column(name="budget", type="float")
     */
    private $budget;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=60)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="datetime")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="datetime")
     */
    private $dateFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_type", type="integer")
     */
    private $idType;

    /**
     * @var float
     */
    private $inflation;

    // construct
    public function __construct () 
    {
        $this->inflation = 0.0;
    }

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
     * @return Compaign
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
     * Set budget
     *
     * @param float $budget
     *
     * @return Compaign
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return float
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Compaign
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Compaign
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Compaign
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set idType
     *
     * @param integer $idType
     *
     * @return Compaign
     */
    public function setIdType($idType)
    {
        $this->idType = $idType;

        return $this;
    }

    /**
     * Get idType
     *
     * @return integer 
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Set inflation
     *
     * @param float $inflation
     *
     * @return Compaign
     */
    public function setInflation($inflation)
    {
        $this->inflation = $inflation;

        return $this;
    }

    /**
     * Get inflation
     *
     * @return float 
     */
    public function getInflation()
    {
        return $this->inflation;
    }


    public function getCompaignMonths () 
    {
        // the current months
        // these date ...
        $date = new \DateTime();
        $currentMonth = $date->format('m');
        $months = array();
        for($i=(int)$currentMonth; $i>0; $i--)
        {
            $m = (new \DateTime())->modify( '-' . $i+1 . ' month');
            $class = new \stdClass;
            $class->id = $m->format('m');
            $class->format = $m->format('F');
            // push_back now
            $months[] = $class;
        }
        // return
        return $months;
    }

    /** 
    * getting for the date param
    */
    public function getCompaigns ($doctrine, $date) 
    {
        $return = array();
        $em = $doctrine->getManager();

        // compaign, typecompaign, users
        $return['compaign'] = $em->getRepository('AppBundle:Front\Compaign')->findAllWithType( $date );
        $return['typecompaign'] = $em->getRepository('AppBundle:Front\typeCompaign')->findAll();
        $return['users'] = $em->getRepository('UsersBundle:Users')->findAll();

        // resultat ho any semaine ra anio no resahina
        // resulat ho any volana ra volana no resahina
        $return['marketing'] = $em->getRepository('AppBundle:Front\Compaign')->findMarketing($date);

        // print_r( $return['marketing']);
        
        // return
        return $return;
    }
}

