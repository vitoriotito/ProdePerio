<?php

namespace ProdeBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="Admin")
*/


class Admin {

	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;
	/** @ORM\Column(type="integer") */
	protected $res;
	/** @ORM\Column(type="integer") */
	protected $pron;
	/** @ORM\Column(type="integer") */
    protected $sp;

    
        /**
     * @return mixed
     */
    public function getRes()
    {
        return $this->res;
    }
        /**
     * @return mixed
     */
    public function getPron()
    {
        return $this->pron;
    }
        /**
     * @return mixed
     */
    public function getSp()
    {
        return $this->sp;
    }
}


