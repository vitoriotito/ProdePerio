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

    /**
     * @Assert\Range(
     *      min = 0,
     *      max = 18000,
     *      minMessage = "You must be at least {{ limit }}cm tall to enter",
     *      maxMessage = "You cannot be taller than {{ limit }}cm to enter"
     * )
     */
	/** @ORM\Column(type="integer") */
	protected $legajo;

	/** @ORM\Column(type="date") */
	protected $fechAlta;

    
    protected $pronosticos;

    /** @ORM\Column(type="integer", nullable=true) */
    protected $puntos;
    
    /** @ORM\Column(type="integer") */
    protected $sp;
    
    /** @ORM\Column(type="integer") */
    protected $pron;
    
    /** @ORM\Column(type="integer") */
	protected $res;

    /** @ORM\Column(type="boolean") */
    protected $ad;




    public function __construct()
    {
        parent::__construct();
        $this -> setFechAlta(new \DateTime('now'));
        $this -> setPuntos(0);
        $this -> setSp(0);
        $this -> setPron(0);
        $this -> setRes(0);
        $this -> setAd(0);
        
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

    /**
     * @return mixed
     */
    public function getPuntos()
    {
        return $this->puntos;
    }

    /**
     * @param mixed $puntos
     *
     * @return self
     */
    public function setPuntos($puntos)
    {
        $this->puntos = $puntos;

        return $this;
    }

      /**
     * @return mixed
     */
    public function getSp()
    {
        return $this->sp;
    }

    /**
     * @param mixed $sp
     *
     * @return self
     */
    public function setSp($sp)
    {

        $this->sp = $sp;

        return $this;
    }

    public function sumSp()
    {
        $this->sp++;
        $this->pron--;
        return $this;
    }

      /**
     * @return mixed
     */
    public function getRes()
    {
        return $this->res;
    }

    /**
     * @param mixed $res
     *
     * @return self
     */
    public function setRes($res)
    {
        $this->res = $res;

        return $this;
    }

    public function sumRes()
    {
        $this->res++;
        return $this;
    }

      /**
     * @return mixed
     */
    public function getPron()
    {
        return $this->pron;
    }

    /**
     * @param mixed $pron
     *
     * @return self
     */
    public function setPron($pron)
    {
        $this->pron = $pron;

        return $this;
    }

    public function sumPron()
    {
        $this->pron++;
        return $this;
    }

    public function calcularPuntos($r, $s, $p){
        $pts = $this->getRes() * $r + $this->getSp() * $p + $this->getPron() * $s;
        $this->setPuntos($pts);
    }

    public function resetearUser() {
        $this -> setPuntos(0);
        $this -> setSp(0);
        $this -> setPron(0);
        $this -> setRes(0);
        return $this;
    }

        public function getAd()
    {
        return $this->ad;
    }

    /**
     * @param mixed $ad
     *
     * @return self
     */
    public function setAd($ad)
    {
        $this->ad = $ad;

        return $this;
    }


}