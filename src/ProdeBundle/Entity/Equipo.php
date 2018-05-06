<?php

namespace ProdeBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="Equipo")
*/


class Equipo {

	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;
	/** @ORM\Column(type="string") */
	protected $cod;
	/** @ORM\Column(type="string") */
	protected $nombre;
	/** @ORM\Column(type="string") */
	protected $bandera;
    /** @ORM\Column(type="string") */
    protected $grupo;




    /**
     * @return mixed
     */
    public function getCod()
    {
        return $this->cod;
    }

    /**
     * @param mixed $cod
     *
     * @return self
     */
    public function setCod($cod)
    {
        $this->cod = $cod;

        return $this;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
   

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBandera()
    {
        return $this->bandera;
    }

    /**
     * @param mixed $bandera
     *
     * @return self
     */
    public function setBandera($bandera)
    {
        $this->bandera = $bandera;

        return $this;
    }
}