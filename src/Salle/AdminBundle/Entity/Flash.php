<?php

namespace Salle\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flash
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Salle\AdminBundle\Repository\FlashRepository")
 */
class Flash
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titular", type="text")
     */
    private $titular;

    /**
     * @var string
     *
     * @ORM\Column(name="enlace", type="string", length=255, nullable=true)
     */
    private $enlace;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titular
     *
     * @param string $titular
     * @return Flash
     */
    public function setTitular($titular)
    {
        $this->titular = $titular;

        return $this;
    }

    /**
     * Get titular
     *
     * @return string 
     */
    public function getTitular()
    {
        return $this->titular;
    }

    /**
     * Set enlace
     *
     * @param string $enlace
     * @return Flash
     */
    public function setEnlace($enlace)
    {
        $this->enlace = $enlace;

        return $this;
    }

    /**
     * Get enlace
     *
     * @return string 
     */
    public function getEnlace()
    {
        return $this->enlace;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Flash
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}
