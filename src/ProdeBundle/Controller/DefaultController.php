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



	public function generarPronosticosAction() {
	

		$user = $this->container->get('security.context')->getToken()->getUser();
		$id = $user->getId();
		$em = $this->getDoctrine()->getEntityManager();
		$partidos = $this->getDoctrine()->getRepository('ProdeBundle:Partido')->findAll();
		$pronosticos = $this->getDoctrine()->getRepository('ProdeBundle:Pronostico');
		$query = $pronosticos->createQueryBuilder('p')
			->where('p.idUser = :id')
    		->setParameter('id', $id)
    		->getQuery();
		$yaCreado = $query->getResult();
		


		if (sizeof($yaCreado)<3){ //para tirar una, si ya esta creado no crear
			foreach ($partidos as $pa) {
				$p = new Pronostico();
				$p->setIdUser($id);
				$p->setResultado1(0);
				$p->setResultado2(0);
				$p->setSp(false);
				$p->setRes(false);
				$p->setPron(false);
				$p->setIdPartido($pa);
				$em->persist($p);
			}
		}
	
			$em->flush();
			return $this->indexAction();
	}

	public function ayudaAction()
	{
		return new Response('Ayuda');
	}



	private function findProximosPartidos($cantidad)
	{
		$idUser = $this->container->get('security.context')->getToken()->getUser();
		// $idUser = $user->getId();
		$em = $this->getDoctrine()->getEntityManager();
		$date = new \DateTime('today');
	
		
		$parameters = array(
			'idUser' => $idUser,
			'ayer' => $date
			);
		$query = $em->createQuery('SELECT  equipo1.nombre e1, equipo1.bandera b1, equipo2.nombre e2, equipo2.bandera b2, partido.fecha, partido.resultado1, partido.resultado2, partido.grupo, partido.id id, pronostico.resultado1 pro1, pronostico.resultado2 pro2, pronostico.sp sp, pronostico.pron plen, pronostico.res res
			FROM ProdeBundle:Equipo equipo1 JOIN ProdeBundle:Partido partido WITH
			equipo1.cod = partido.equipo1 JOIN ProdeBundle:Equipo equipo2  WITH equipo2.cod = partido.equipo2
			JOIN ProdeBundle:Pronostico pronostico WITH partido.id = pronostico.idPartido WHERE
			pronostico.idUser=:idUser AND partido.fecha >:ayer
			ORDER BY partido.id ASC') ->setParameters($parameters)
			 ->setMaxResults($cantidad)->getResult();

		return $query;	 
	}

private function findProximosPartidosAnonymus($cantidad)
	{

		$date = new \DateTime('today');
	
		
		$parameters = array(
			'ayer' => $date
			);
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery('SELECT  equipo1.nombre e1, equipo1.bandera b1, equipo2.nombre e2, equipo2.bandera b2, partido.fecha, partido.resultado1, partido.resultado2, partido.grupo, partido.id id
			FROM ProdeBundle:Equipo equipo1 JOIN ProdeBundle:Partido partido WITH
			equipo1.cod = partido.equipo1 JOIN ProdeBundle:Equipo equipo2  WITH equipo2.cod = partido.equipo2 WHERE
			partido.fecha >:ayer	
			ORDER BY partido.id ASC')->setParameters($parameters)
			 ->setMaxResults($cantidad)->getResult();
		
			
		
		return $query;	 
	}

	
	
	private function findPartidosPorGrupo($grupo)
	{
		$idUser = $this->container->get('security.context')->getToken()->getUser();
		$em = $this->getDoctrine()->getEntityManager();
		$parameters = array(
			'idUser' => $idUser,
			'grupo' => $grupo
			);

		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery('SELECT  equipo1.nombre e1, equipo1.bandera b1, equipo2.nombre e2, equipo2.bandera b2, partido.fecha, partido.resultado1, partido.resultado2, partido.grupo, partido.id id, pronostico.resultado1 pro1, pronostico.resultado2 pro2, pronostico.sp sp, pronostico.pron plen, pronostico.res res
			FROM ProdeBundle:Equipo equipo1 JOIN ProdeBundle:Partido partido WITH
			equipo1.cod = partido.equipo1 JOIN ProdeBundle:Equipo equipo2  WITH equipo2.cod = partido.equipo2
			JOIN ProdeBundle:Pronostico pronostico WITH partido.id = pronostico.idPartido
			WHERE partido.grupo=:grupo AND pronostico.idUser=:idUser
			ORDER BY partido.id ASC')
			 ->setParameters($parameters)
			 ->getResult();
		

				
		return $query;	 
	}

	
	
	public function indexAction()
	{

		$pos=0;
		$me=array();
		$usuarios = $this->listarUsuarios(0); // 0 porque son todos
		if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
			$partidos = $this->findProximosPartidos(6);
			$myId=$this->getUser()->getId();
	
			for ($i=0; $i<sizeof($usuarios); $i++){
					if ($usuarios[$i]->getId() == $myId ) {
								$pos=$i+1;	
					}
			}
			$me = $this->findMe();
		} else {
			$partidos = $this->findProximosPartidosAnonymus(6);
		}
		
		

		$now = new \DateTime('now');	
		$em = $this->getDoctrine()->getEntityManager();

		if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
			$partidos = $this->findPartidosSinResultado();
			$partidosSide = $this->findPartidosSide();
			return $this->render('ProdeBundle:Default:portadaAdmin.html.twig', 
			array('partidos' => $partidos,
				 'partidosSidebar' => $partidosSide));
		}
		
		return $this->render('ProdeBundle:Default:portada.html.twig', 
			array('partidos' => $partidos, 
				'usuarios' => $usuarios,
				'pos'=>$pos,
				'me'=>$me));
	}

	public function findMe(){
		$em = $this->getDoctrine()->getEntityManager();
		$me = $em->getRepository('ProdeBundle:User')->findById(
				array(
					  'id'=> $this->getUser()->getId())
			);	
			return $me[0];		
	}

	public function verTodosPronosticosAction() {
		$usuarios = $this->listarUsuarios(0); // 0 porque son todos
		$partidos = $this->buscarTodosPronosticos();
		$myId=$this->getUser()->getId();
		for ($i=0; $i<sizeof($usuarios); $i++){
				if ($usuarios[$i]->getId() == $myId ) {
						$pos=$i+1;	
					}
			}
			$me = $this->findMe();


		return $this->render('ProdeBundle:Default:portada.html.twig',
			array('partidos' => $partidos, 
				'usuarios' => $usuarios,
				'pos'=>$pos,
				'me'=>$me));
	}

	private function buscarTodosPronosticos(){
		$idUser = $this->container->get('security.context')->getToken()->getUser();
		$em = $this->getDoctrine()->getEntityManager();
		$parameters = array(
			'idUser' => $idUser
			);

		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery('SELECT  equipo1.nombre e1, equipo1.bandera b1, equipo2.nombre e2, equipo2.bandera b2, partido.fecha, partido.resultado1, partido.resultado2, partido.grupo, partido.id id, pronostico.resultado1 pro1, pronostico.resultado2 pro2, pronostico.sp sp, pronostico.pron plen, pronostico.res res
			FROM ProdeBundle:Equipo equipo1 JOIN ProdeBundle:Partido partido WITH
			equipo1.cod = partido.equipo1 JOIN ProdeBundle:Equipo equipo2  WITH equipo2.cod = partido.equipo2
			JOIN ProdeBundle:Pronostico pronostico WITH partido.id = pronostico.idPartido
			WHERE pronostico.idUser=:idUser
			ORDER BY partido.id ASC')
			 ->setParameters($parameters)
			 ->getResult();
	
		return $query;	 
	}

	public function guardarResultadosAction(Request $request){

		    {
		    	$params = array();
		    	$content = $this->get("request")->getContent();
		    	if (!empty($content))
   		 	{
       			 $params = json_decode($content, true); // 2nd param to get as array
    		}	

		
		$em = $this->getDoctrine()->getManager();
		$partido = $em->getRepository('ProdeBundle:Partido')->findOneBy(
				array(
					  'id'=> $params[0]['id'])
			);
			$r1 = intval($params[0]['r1']);		
			$r2 = intval($params[0]['r2']);
			
			$partido->setResultado1($r1);
			$partido->setResultado2($r2);
			$em->flush();
			}

			$this->calcularPuntosPorPartido();	
			$this->calculado($params[0]['id']);
			

        return $this->render('ProdeBundle:Default:base.html.twig');

    }

    private function calculado($id){
    		$em = $this->getDoctrine()->getManager();
			$partido = $em->getRepository('ProdeBundle:Partido')->findOneBy(
				array(
					  'id'=> $id)
			);			
			$partido->setCalculado(1);
			$em->flush();
			}
    

	private function findPartidosSide(){
		
		$maniana = new \Datetime('tomorrow');
		$ayer = new \Datetime('yesterday');
		$parameters = array(
		'maniana' => $maniana, 
		'ayer' => $ayer
		);
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery('SELECT  equipo1.nombre e1, equipo1.bandera b1, equipo2.nombre e2, equipo2.bandera b2, partido.fecha, partido.resultado1, partido.resultado2, partido.grupo, partido.id id, partido.calculado calculado
			FROM ProdeBundle:Equipo equipo1 JOIN ProdeBundle:Partido partido WITH
			equipo1.cod = partido.equipo1 JOIN ProdeBundle:Equipo equipo2  WITH equipo2.cod = partido.equipo2
			WHERE partido.fecha<:maniana AND partido.fecha >:ayer
			ORDER BY partido.id ASC')
			->setParameters($parameters)
			->getResult();

		return $query;	 	
}
	
	private function findPartidosSinResultado(){
		
			$jugado = new \Datetime('+2 hours');
			$parameters = array(
			'jugado' => $jugado
			);
			$em = $this->getDoctrine()->getEntityManager();
			$query = $em->createQuery('SELECT  equipo1.nombre e1, equipo1.bandera b1, equipo2.nombre e2, equipo2.bandera b2, partido.fecha, partido.resultado1, partido.resultado2, partido.grupo, partido.id id
				FROM ProdeBundle:Equipo equipo1 JOIN ProdeBundle:Partido partido WITH
				equipo1.cod = partido.equipo1 JOIN ProdeBundle:Equipo equipo2  WITH equipo2.cod = partido.equipo2
				WHERE partido.fecha<:jugado AND partido.calculado = 0
				ORDER BY partido.id ASC')
				->setParameters($parameters)
				->setMaxResults(1)->getResult();
	
			return $query;	 	
	}


	
	private function findPronosticosPorPartido($partido) {

		$parameters = array(
			'partido' => $partido
			);
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery('SELECT p
			FROM ProdeBundle:Pronostico p 
			WHERE p.idPartido=:partido')
			 ->setParameters($parameters)
			 ->getResult();
		return $query;	
	}


	public function calcularPuntosPorPartido(){
		$em = $this->getDoctrine()->getEntityManager();
		$partido = $this->buscarUltimoPartidoSinCalcular();
		$pleno=array(); //aca guardo los id de los plenos, si es uno solo es superpleno
		$plenArr = array();
		if (sizeof($partido) != 0 ){
			$pronosticos = $this->findPronosticosPorPartido($partido);
			$puntajes = $this->getPuntajes();
			$r1 = $partido[0]->getResultado1();
			$r2 = $partido[0]->getResultado2();
			$empatePtd=$this->empate($r1, $r2);
			$ganadorPtd=$this->ganador($r1, $r2);
			foreach ($pronosticos as $p) { //iterar sobre los pronosticos
				$valido = false;
	
				$pron1=$p->getResultado1();
				$pron2=$p->getResultado2();
				
				if (is_numeric($pron1) && is_numeric($pron2) ) {
					$valido = true;
				}

				$empatePron = $this->empate($pron1, $pron2);
				$u = $p->getIdUser();
				if ($valido){
					if ($empatePtd && $empatePron ) { //si la pego con empate
							if ($this->pleno($r1, $r2, $pron1, $pron2)){
								$p->setPron(1);
								$this->actualizarPuntos($u, "pleno", $puntajes);
								$plenArr[0]=$u;
								$plenArr[1]=$p->getId();
								array_push($pleno, $plenArr); //guardo id de pleno
							} else {
								$p->setRes(1);
								$this->actualizarPuntos($u, "resultado", $puntajes);
		
							}
					} else { //si no fue empate
							$ganadorPron = $this->ganador($pron1, $pron2);
							if ($ganadorPron != $ganadorPtd) { //si no pego nada
							} else { //si pego ganador
								if ($this->pleno($r1, $r2, $pron1, $pron2)){
									$p->setPron(1);
									$this->actualizarPuntos($u, "pleno", $puntajes);
									$plenArr[0]=$u;
									$plenArr[1]=$p->getId();
									array_push($pleno, $plenArr); //guardo id de pleno
								} else {
									$p->setRes(1);
									$this->actualizarPuntos($u, "resultado", $puntajes);
								}
							}
					}
					$em->persist($p);
				}	
			}
			$em->flush();
		}
	
		dump($pleno);
		if (sizeof($pleno) == 1){
				$this->calcularSp($pleno, $puntajes);
		}
		
		
	}

	private function calcularSP($pleno, $pun){
	
			$em = $this->getDoctrine()->getEntityManager();
			$user = $this->getDoctrine()
				->getRepository('ProdeBundle:User')->findOneById($pleno[0][0]);

			$p = $this->getDoctrine()
				->getRepository('ProdeBundle:Pronostico')->findOneById($pleno[0][1]);	
			$p->setPron(0);
			$p->setSp(1); //probar si anda superpleno
			$user->sumSp();	
			$user->calcularPuntos($pun->getRes(), $pun->getPron(), $pun->getSp());
			$em->flush();

		
		return $this;
	}

	private function actualizarPuntos($u, $resultado, $pun) {
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $this->getDoctrine()
		->getRepository('ProdeBundle:User');
		$user = $repository->findOneById($u);
		if($resultado=="resultado"){
			$user->sumRes();
		} else {
			$user->sumPron();
		}
		$user->calcularPuntos($pun->getRes(), $pun->getPron(), $pun->getSp());
		$em->flush();

	}




	private function getPuntajes(){
		$repository = $this->getDoctrine()
		->getRepository('ProdeBundle:Admin');
		$pun = $repository->findOneById(1);
		return $pun;
	}

	private function empate($r1, $r2){
		
		$e = abs($r1-$r2);
		if ($e == 0) {
			return true;
		}
		return false;
	}

	private function ganador($r1, $r2){
		if ($this->empate($r1, $r2)){
			return -1;
		}
		$max = max($r1, $r2);
		if ($max - $r1 == 0) {
			return 1;
		}
		return 2;
	}

	private function pleno($r1, $r2, $p1, $p2){
		if ($r1==$p1 && $r2 == $p2){
			return true;
		}
		return false;
	}

	private function ganadorComp($r1, $r2, $p1, $p2){
		if ($r1 > $r2 && $p1 > $p2){
			return true;
		}
		return false;
	}

	public function calcularAction(){

		$this->calcularPuntosPorPartido();

		$partidos = $this->findProximosPartidos(6);
		$usuarios = $this->listarUsuarios(0); // 0 porque son todos
		$me = $this->findMe();
		return $this->render('ProdeBundle:Default:portada.html.twig', 
			array('partidos' => $partidos, 
				'usuarios' => $usuarios,
				'me' => $me,
				'pos' => 1	
			));
	}

	private function buscarUltimoPartidoSinCalcular(){

		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery('SELECT p
			FROM ProdeBundle:Partido p 
			WHERE p.calculado = false AND p.resultado1 IS NOT NULL
			ORDER BY  p.fecha ASC') 
			 ->setMaxResults(1)->getResult();
		return $query;	
	}

	public function grupoAction($grupo="A")
	{
	

		$partidos = $this->findPartidosPorGrupo($grupo);
		$usuarios = $this->listarUsuarios(0);
		$myId=$this->getUser()->getId();
	
			for ($i=0; $i<sizeof($usuarios); $i++){
					if ($usuarios[$i]->getId() == $myId ) {
								$pos=$i+1;	
					}
			}
		$me = $this->findMe();

		return $this->render('ProdeBundle:Default:pronosticosGrupos.html.twig', array(
							 'partidos' => $partidos,
							 'usuarios' => $usuarios,
							 'pos'=>$pos,
							 'me'=>$me));
	}
    

	private function listarUsuarios($cant){
		$em = $this->getDoctrine()->getEntityManager(); 
		if ($cant==0){

			$query = $em->createQuery('SELECT u FROM ProdeBundle:User u WHERE u.ad = 0
			 	 ORDER BY u.puntos DESC');
			$u = $query->getResult();
			
		} else {
			$query = $em->createQuery('SELECT u FROM ProdeBundle:User u WHERE u.ad = 0
			 	 ORDER BY u.puntos DESC');
			$u = $query->getMaxResults($cant);
		}
		
		return $u;
	}

    public function guardarPronosticosAction(Request $request)
    {
    	$params = array();
    	$content = $this->get("request")->getContent();
    	if (!empty($content))
   		 	{
       			 $params = json_decode($content, true); // 2nd param to get as array
    		}	


		$user = $this->container->get('security.context')->getToken()->getUser();
		$id = $user->getId();
		
		$em = $this->getDoctrine()->getManager();
		for ($i=0; $i< sizeof($params); $i++){
			$ambosResSonNumber = false;
			$r1 = $params[$i]['r1'];
			$r2 = $params[$i]['r2'];

			if (is_numeric($r1) && is_numeric($r2)){
				$ambosResSonNumber = true;
			}


			$pronostico = $em->getRepository('ProdeBundle:Pronostico')->findOneBy(
				array('idUser'  => $id, 
					  'idPartido'=> $params[$i]['id'])
			);
			$now = new \DateTime('now');
			$habilitado=false;
			$fechaPartido = $pronostico->getIdPartido()->getFecha();
			$fechaPartido = $fechaPartido->modify( '-1 hours' ); //le saco una hora

			if($fechaPartido>$now){
				$habilitado = true;
			}
			if($habilitado && $ambosResSonNumber){
				$pronostico->setResultado1($params[$i]['r1']);
				$pronostico->setResultado2($params[$i]['r2']);
				$em->flush();
			}

		}
		

		// $parameters = array(
		// 	'partido' => $p,
		// 	'user' => $id
		// 	);
		// $em = $this->getDoctrine()->getEntityManager();
		// $pronostico = $em->createQuery('SELECT p
		// 	FROM ProdeBundle:Pronostico p 
		// 	WHERE p.idPartido=:partido
		// 	AND p.idUser=:user')
		// 	 ->setParameters($parameters)
		// 	 ->getResult();
		


	
		// $pronostico[0]->setIdUser($user->getId());
		// $pronostico[0]->setIdPartido($p);
		// $pronostico[0]->setResultado1($params['r1']);
		// $pronostico[0]->setResultado2($params['r2']);
		// $pronostico[0]->setRes(false);
		// $pronostico[0]->setPron(false);
		// $pronostico[0]->setSp(false);
		// $em = $this->getDoctrine()->getEntityManager();
 
        // //Persistimos en el objeto
        // $em->persist($pronostico);
 
        // //Insertarmos en la base de datos
        // $flush = $em->flush();

        return $this->render('ProdeBundle:Default:base.html.twig');

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
