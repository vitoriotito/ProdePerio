<?php
// src/prodeBundle/Entity/User.php

namespace ProdeBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(type="string") */
	protected $nombre;

	/** @ORM\Column(type="string") */
	protected $apellido;


	/** @ORM\Column(type="string") */
	protected $equipo;

	/** @ORM\Column(type="integer") */
	protected $legajo;

	/** @ORM\Column(type="date") */
	protected $fechAlta;

    
    protected $pronosticos;




    public function __construct()
    {
        parent::__construct();
        $this -> setFechAlta(new \DateTime('now'));


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
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     *
     * @return self
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    

    /**
     * @return mixed
     */
    public function getEquipo()
    {
        return $this->equipo;
    }

    /**
     * @param mixed $equipo
     *
     * @return self
     */
    public function setEquipo($equipo)
    {
        $this->equipo = $equipo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLegajo()
    {
        return $this->legajo;
    }

    /**
     * @param mixed $legajo
     *
     * @return self
     */
    public function setLegajo($legajo)
    {
        $this->legajo = $legajo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechAlta()
    {
        return $this->fechAlta;
    }

    /**
     * @param mixed $fechAlta
     *
     * @return self
     */
    public function setFechAlta($fechAlta)
    {
        $this->fechAlta = $fechAlta;

        return $this;
    }
}