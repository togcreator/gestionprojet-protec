<?php

namespace MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MailPJ
 *
 * @ORM\Table(name="mail_pj", indexes={@ORM\Index(name="ByMail", columns={"idMail", "id"})})
 * @ORM\Entity(repositoryClass="MailBundle\Repository\MailPJRepository")
 * @ORM\HaslifecycleCallbacks
 */
class MailPJ
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
     *
     * @ORM\ManyToOne(targetEntity="MailBundle\Entity\Mail", inversedBy="mailPJ")
     * @ORM\JoinColumn(name="idMail", referencedColumnName="id", nullable=true)
     */
    private $mail;

    /**
     * @var int
     *
     * @ORM\Column(name="typePj", type="integer", options={"default": 0})
     */
    private $typePj;

    /**
     * @var string
     *
     * @ORM\Column(name="nomPj", type="string", length=255)
     * @Assert\NotBlank
     */
    private $nomPj;

    /**
     * @var int
     *
     * @ORM\Column(name="idBiblio", type="integer", options={"default": 0})
     */
    private $idBiblio;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=5)
     */
    private $version;

    /**
     * @var UploadedFile
     *
     *@Assert\File(mimeTypes={ "application/pdf" })
     */
    public $file;




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
     * Set typePj
     *
     * @param integer $typePj
     *
     * @return MailPJ
     */
    public function setTypePj($typePj)
    {
        $this->typePj = $typePj;

        return $this;
    }

    /**
     * Get typePj
     *
     * @return int
     */
    public function getTypePj()
    {
        return $this->typePj;
    }

    /**
     * Set nomPj
     *
     * @param string $nomPj
     *
     * @return MailPJ
     */
    public function setNomPj($nomPj)
    {
        $this->nomPj = $nomPj;

        return $this;
    }

    /**
     * Get nomPj
     *
     * @return string
     */
    public function getNomPj()
    {
        return $this->nomPj;
    }

    /**
     * Set idBiblio
     *
     * @param integer $idBiblio
     *
     * @return MailPJ
     */
    public function setIdBiblio($idBiblio)
    {
        $this->idBiblio = $idBiblio;

        return $this;
    }

    /**
     * Get idBiblio
     *
     * @return int
     */
    public function getIdBiblio()
    {
        return $this->idBiblio;
    }

    /**
     * Set version
     *
     * @param string $version
     *
     * @return MailPJ
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set mail
     *
     * @param \MailBundle\Entity\Mail $mail
     *
     * @return MailPJ
     */
    public function setMail(\MailBundle\Entity\Mail $mail = null)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return \MailBundle\Entity\Mail
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return MailPJ
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        return $this;
    }
}
