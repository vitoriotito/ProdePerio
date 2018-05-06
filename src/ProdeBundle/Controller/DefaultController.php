<?php

namespace ProdeBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use ProdeBundle\Entity\Pronostico;
use ProdeBundle\Entity\User;
use ProdeBundle\Entity\Partido;
use ProdeBundle\Entity;
use Psr\Log\LoggerInterface;



class DefaultController extends Controller
{



	public function ayudaAction()
	{
		return new Response('Ayuda');
	}

	private function findProximosPartidos($cantidad)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery('SELECT equipo1.nombre e1, equipo1.bandera b1, equipo2.nombre e2, equipo2.bandera b2, partido.fecha, partido.resultado1, partido.resultado2, partido.grupo
			FROM ProdeBundle:Equipo equipo1 JOIN ProdeBundle:Partido partido WITH
			equipo1.cod = partido.equipo1 JOIN ProdeBundle:Equipo equipo2  WITH equipo2.cod = partido.equipo2')
			 ->setMaxResults($cantidad)->getResult();
		return $query;	 
	}

	private function findPartidosPorGrupo($grupo)
	{
		$parameters = array(
						    'grupo' => $grupo
							);
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery('SELECT equipo1.nombre e1, equipo1.bandera b1, equipo2.nombre e2, equipo2.bandera b2, partido.fecha, partido.resultado1, partido.resultado2, partido.grupo
			FROM ProdeBundle:Equipo equipo1 JOIN ProdeBundle:Partido partido WITH
			equipo1.cod = partido.equipo1 JOIN ProdeBundle:Equipo equipo2  WITH equipo2.cod = partido.equipo2
			WHERE partido.grupo=:grupo
			ORDER BY partido.fecha ASC')
			 ->setParameters($parameters)
			 ->getResult();
		return $query;	 
	}

	public function indexAction()
	{


		$partidos = $this->findProximosPartidos(6);
			
		$em = $this->getDoctrine()->getEntityManager();
		
		return $this->render('ProdeBundle:Default:portada.html.twig', array(
							 'partidos' => $partidos));
	}

	

	public function grupoAction($grupo="A")
	{
	

		$partidos = $this->findPartidosPorGrupo($grupo);
			
		$em = $this->getDoctrine()->getEntityManager();
		
		return $this->render('ProdeBundle:Default:pronosticosGrupos.html.twig', array(
							 'partidos' => $partidos));
	}
    


    public function guardarPronosticoAction(Request $request)
    {
    	$params = array();
    	$content = $this->get("request")->getContent();
    	if (!empty($content))
   		 	{
       			 $params = json_decode($content, true); // 2nd param to get as array
    		}	
 		

		$user = $this->container->get('security.context')->getToken()->getUser();
		$user->getId();

        $p = $this->getDoctrine()
        ->getRepository(Partido::class)
        ->find(1);
 

		$pronostico = new Pronostico();
		$pronostico->setIdUser($user->getId());
		$pronostico->setIdPartido($p);
		$pronostico->setResultado1($params['r1']);
		$pronostico->setResultado2($params['r2']);
		$pronostico->setSp(false);
		$em = $this->getDoctrine()->getEntityManager();
 
        //Persistimos en el objeto
        $em->persist($pronostico);
 
        //Insertarmos en la base de datos
        $flush = $em->flush();

    }


	public function registroAction()
	{
		return $this->render('ProdeBundle:FOS:layout.html.twig');
	}

	public function guardarGrupoAction()
	{
		return $this->render('ProdeBundle:Default:portada.html.twig');
	}
}
