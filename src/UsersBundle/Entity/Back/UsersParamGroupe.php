<?php

namespace UsersBundle\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserParamGroupe
 *
 * @ORM\Table(name="param_user_groupe")
 * @ORM\Entity(repositoryClass="UsersBundle\Repository\UserParamGroupeRepository")
 * @ProjectBundle\Annotation\Label\LabelClass
 */
class UsersParamGroupe
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
     * @ORM\Column(name="code", type="string", length=20)
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="typeAdmin", type="integer")
     */
    private $typeAdmin;

    /**
     * @var int
     *
     * @ORM\Column(name="ouvert", type="integer")
     */
    private $ouvert;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="lib0", type="string", length=80)
     */
    private $lib0;

    /**
     * @var string
     *
     * @ORM\Column(name="lib1", type="string", length=80)
     */
    private $lib1;

    /**
     * @var string
     *
     * @ORM\Column(name="lib2", type="string", length=80)
     */
    private $lib2;

    /**
     * @var string
     *
     * @ORM\Column(name="lib3", type="string", length=80)
     */
    private $lib3;

    /**
     * @var string
     *
     * @ORM\Column(name="lib4", type="string", length=80)
     */
    private $lib4;

    /**
     * @var string
     *
     * @ORM\Column(name="lib5", type="string", length=80)
     */
    private $lib5;

    /**
     * @var string
     *
     * @ORM\Column(name="lib6", type="string", length=80)
     */
    private $lib6;

    /**
     * @var string
     *
     * @ORM\Column(name="lib7", type="string", length=80)
     */
    private $lib7;

    /**
     * @var string
     *
     * @ORM\Column(name="lib8", type="string", length=80)
     */
    private $lib8;

    /**
     * @var string
     *
     * @ORM\Column(name="lib9", type="string", length=80)
     */
    private $lib9;

    /**
     * @var string
     *
     * @ORM\Column(name="table", type="string", length=40)
     */
    private $table;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=100)
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="integer", length=100)
     */
    private $version = 0;


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
     * @return UserParamGroupe
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
     * Set typeAdmin
     *
     * @param integer $typeAdmin
     *
     * @return UserParamGroupe
     */
    public function setTypeAdmin($typeAdmin)
    {
        $this->typeAdmin = $typeAdmin;

        return $this;
    }

    /**
     * Get typeAdmin
     *
     * @return int
     */
    public function getTypeAdmin()
    {
        return $this->typeAdmin;
    }

    /**
     * Set ouvert
     *
     * @param integer $ouvert
     *
     * @return UserParamGroupe
     */
    public function setOuvert($ouvert)
    {
        $this->ouvert = $ouvert;

        return $this;
    }

    /**
     * Get ouvert
     *
     * @return int
     */
    public function getOuvert()
    {
        return $this->ouvert;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return UserParamGroupe
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
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
     * @return UserParamGroupe
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
     * @return UserParamGroupe
     */
    public function setLib1($lib1)
    {
        $this->lib1 = $lib1;

        return $this;
    }

    /**
     * Get lib1
     *
     * @return string
     */
    public function getLib1()
    {
        return $this->lib1;
    }

    /**
     * Set lib2
     *
     * @param string $lib2
     *
     * @return UserParamGroupe
     */
    public function setLib2($lib2)
    {
        $this->lib2 = $lib2;

        return $this;
    }

    /**
     * Get lib2
     *
     * @return string
     */
    public function getLib2()
    {
        return $this->lib2;
    }

    /**
     * Set lib3
     *
     * @param string $lib3
     *
     * @return UserParamGroupe
     */
    public function setLib3($lib3)
    {
        $this->lib3 = $lib3;

        return $this;
    }

    /**
     * Get lib3
     *
     * @return string
     */
    public function getLib3()
    {
        return $this->lib3;
    }

    /**
     * Set lib4
     *
     * @param string $lib4
     *
     * @return UserParamGroupe
     */
    public function setLib4($lib4)
    {
        $this->lib4 = $lib4;

        return $this;
    }

    /**
     * Get lib4
     *
     * @return string
     */
    public function getLib4()
    {
        return $this->lib4;
    }

    /**
     * Set lib5
     *
     * @param string $lib5
     *
     * @return UserParamGroupe
     */
    public function setLib5($lib5)
    {
        $this->lib5 = $lib5;

        return $this;
    }

    /**
     * Get lib5
     *
     * @return string
     */
    public function getLib5()
    {
        return $this->lib5;
    }

    /**
     * Set lib6
     *
     * @param string $lib6
     *
     * @return UserParamGroupe
     */
    public function setLib6($lib6)
    {
        $this->lib6 = $lib6;

        return $this;
    }

    /**
     * Get lib6
     *
     * @return string
     */
    public function getLib6()
    {
        return $this->lib6;
    }

    /**
     * Set lib7
     *
     * @param string $lib7
     *
     * @return UserParamGroupe
     */
    public function setLib7($lib7)
    {
        $this->lib7 = $lib7;

        return $this;
    }

    /**
     * Get lib7
     *
     * @return string
     */
    public function getLib7()
    {
        return $this->lib7;
    }

    /**
     * Set lib8
     *
     * @param string $lib8
     *
     * @return UserParamGroupe
     */
    public function setLib8($lib8)
    {
        $this->lib8 = $lib8;

        return $this;
    }

    /**
     * Get lib8
     *
     * @return string
     */
    public function getLib8()
    {
        return $this->lib8;
    }

    /**
     * Set lib9
     *
     * @param string $lib9
     *
     * @return UserParamGroupe
     */
    public function setLib9($lib9)
    {
        $this->lib9 = $lib9;

        return $this;
    }

    /**
     * Get lib9
     *
     * @return string
     */
    public function getLib9()
    {
        return $this->lib9;
    }

    /**
     * Set table
     *
     * @param string $table
     *
     * @return UserParamGroupe
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Get table
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set img
     *
     * @param string $img
     *
     * @return UserParamGroupe
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set obs
     *
     * @param string $obs
     *
     * @return UserParamGroupe
     */
    public function setObs($obs)
    {
        $this->obs = $obs;

        return $this;
    }

    /**
     * Get obs
     *
     * @return string
     */
    public function getObs()
    {
        return $this->obs;
    }

    /**
     * Set valide
     *
     * @param string $valide
     *
     * @return UserParamGroupe
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return string
     */
    public function getValide()
    {
        return $this->valide;
    }
}

