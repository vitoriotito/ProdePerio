<?php

namespace ProdeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
	public function ayudaAction()
	{
		return new Response('Ayuda');
	}

	public function indexAction()
	{
		return $this->render('ProdeBundle:Default:portada.html.twig');
	}

	public function pronosticosGruposAction()
	{
		return $this->render('ProdeBundle:Default:pronosticosGrupos.html.twig');
	}

	public function registroAction()
	{
		return $this->render('ProdeBundle:FOS:layout.html.twig');
	}
}
