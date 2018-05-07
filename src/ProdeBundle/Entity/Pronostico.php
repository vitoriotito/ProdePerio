<?php 

namespace ProdeBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity
* @ORM\Table(name="Pronostico")
*/


class Pronostico {

	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/** @ORM\Column(type="integer")*/
	protected $idUser;

	
	/** @ORM\ManyToOne(targetEntity="Partido", inversedBy="cod") */
   
	protected $idPartido;

	/** @ORM\Column(type="string") */
	protected $resultado1;

	/** @ORM\Column(type="integer") */
	protected $resultado2;

    /** @ORM\Column(type="boolean") */
    protected $sp = false;

    /** @ORM\Column(type="boolean", nullable=true) */
    protected $pron;

    /** @ORM\Column(type="boolean") */
    protected $res;

	
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     *
     * @return self
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdPartido()
    {
        return $this->idPartido;
    }

    /**
     * @param mixed $idPartido
     *
     * @return self
     */
    public function setIdPartido($idPartido)
    {
        $this->idPartido = $idPartido;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResultado1()
    {
        return $this->resultado1;
    }

    /**
     * @param mixed $resultado1
     *
     * @return self
     */
    public function setResultado1($resultado1)
    {
        $this->resultado1 = $resultado1;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResultado2()
    {
        return $this->resultado2;
    }

    /**
     * @param mixed $resultado2
     *
     * @return self
     */
    public function setResultado2($resultado2)
    {
        $this->resultado2 = $resultado2;

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

}