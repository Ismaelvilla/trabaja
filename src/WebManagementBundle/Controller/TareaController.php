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

        return $this->render('WebManagementBundle:Tarea:index.html.twig', array('tareas' => $tareas));
    }

    public function nuevaAjaxAction(Request $request){
        //Obtenemos el usuario
        $usuario = $this->getUser();

        $nombreTarea = $request->query->get('nombreTarea');

        //cogemos el entity
        $entity = $this->getDoctrine()->getManager();
        $tareaRepository = $entity->getRepository('WebManagementBundle:Tarea');
        $tareaRepository->newTask($entity, $nombreTarea, $usuario->getId());

        //obtenemos todas las tareas para mostrar
        $tareas = $tareaRepository->findAll();
        $retorno = $this->render('WebManagementBundle:Tarea:gridTareas.html.twig', array('tareas' => $tareas));

        $json = array(
            'redirect'=>$retorno
        );
        return new JsonResponse($json);
    }
}
