<?php

namespace WebManagementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class TareaController extends Controller
{

    public function indexAction()
    {
        //cogemos el entity
        $entity = $this->getDoctrine()->getManager();

        $tareaRepository = $entity->getRepository('WebManagementBundle:Tarea');
        $tareas = $tareaRepository->findAll();

        return $this->render('WebManagementBundle:Tarea:index.html.twig', array('tareas'=> $tareas));
    }
}