<?php

namespace ProdeBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="Partido")
*/



class Partido {

	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	
	*/
	protected $id;
	/**
	* @ORM\OneToMany(targetEntity="Pronostico", mappedBy="idPartido")
	*/
	protected $cod;
	/** @ORM\Column(type="string", nullable=true) */
	protected $grupo;
	/** @ORM\Column(type="string") */

	protected $equipo1;
	/** @ORM\Column(type="integer", nullable=true) */
	protected $resultado1;
	/** @ORM\Column(type="string", nullable=true) */

	protected $equipo2;
	/** @ORM\Column(type="integer", nullable=true) */
	protected $resultado2;
	/** @ORM\Column(type="datetime") */
	protected $fecha;

	
	public function getIdpartido()
	{
		return $this->idPartido;
	}

	public function __toString()
	{
		return $this->getCod();
	}


	public function getCod()
	{
		return $this->cod;
	}

	public function setCod($cod)
	{
		$this->cod = $cod;
	}

	
	public function getResultado1()
	{
		return $this->resultado1;
	}

	public function setResultado1($resultado1)
	{
		$this->cod = $resultado1;
	}

	public function getEquipo1()
	{
		return $this-> equipo1;
	}

	public function setEquipo1($equipo1)
	{
		$this->cod = $equipo1;
	}

	public function getEquipo2()
	{
		return $this->equipo2;
	}

	public function setEquipo2($equipo2)
	{
		$this->cod = $equipo2;
	}

	public function getResultado2()
	{
		return $this->resultado2;
	}

	public function setResultado2($resultado2)
	{
		$this->cod = $resultado2;
	}


    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

    }

        public function getGrupo()
    {
        return $this->grupo;
    }

    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

    }


}
