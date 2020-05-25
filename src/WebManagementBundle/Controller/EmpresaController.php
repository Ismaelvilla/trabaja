<?php

namespace WebManagementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class EmpresaController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {

        //vamos a recoger las empresas y las vamos a mostrar
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryEmpresa = $entityManager->getRepository('WebManagementBundle:Empresa');
        $empresas = $repositoryEmpresa->findAll();

        return $this->render('WebManagementBundle:Empresa:index.html.twig', array('empresas'=>$empresas));
    }

    public function addAction(){
        //vamos a crear una empresa vacia
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryEmpresa = $entityManager->getRepository('WebManagementBundle:Empresa');
        $idEmpresa= $repositoryEmpresa->add($entityManager);

        return $this->redirectToRoute('empresas_edit', array('id'=>$idEmpresa));
    }

    public function detailsAction(Request $request){
        // conseguimos el id de empresa
        $idEmpresa = $request->attributes->get('id');

        //vamos a buscar la empresa
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryEmpresa = $entityManager->getRepository('WebManagementBundle:Empresa');
        $empresa = $repositoryEmpresa->find($idEmpresa);

        //vamos a sacar las provincias


        echo "el id de empresa es: ".$idEmpresa;
        return $this->render('WebManagementBundle:Empresa:details.html.twig', array('empresa' => $empresa));
        //return new Response('estamos en details');
    }

    public function deleteAction(Request $request){
        //conseguimos el id de empresa
        $idEmpresa = $request->attributes->get('id');

        //vamos a buscar la empresa
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryEmpresa = $entityManager->getRepository('WebManagementBundle:Empresa');
        $empresa = $repositoryEmpresa->find($idEmpresa);

        //borramos la empresa
        $entityManager->remove($empresa);
        $entityManager->flush();

        $json = array(
            'redirect'=>$this->generateUrl('empresas_index')
        );
        return new JsonResponse($json);
    }

    public function updateAction(Request $request){
        //conseguimos el id de empresa
        $idEmpresa = $request->attributes->get('id');
        $csr_token = $request->request->get('_csrf_token');
        $data = $request->request->all();

        //buscamos la empresa
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryEmpresa = $entityManager->getRepository('WebManagementBundle:Empresa');
        $empresa = $repositoryEmpresa->find($idEmpresa);

        if ($this->isCsrfTokenValid('edit_notification', $csr_token)) {
            $empresa->setNombre($data['nombre']);
            $empresa->setCategoria($data['categoria']);
            $empresa->setProvincia($data['provincia']);
            $empresa->setPoblacion($data['poblacion']);
            $empresa->setEmail($data['email']);
            $empresa->setPrioridad($data['prioridad']);
            $entityManager->flush();
        }


        $json = array(
           // 'redirect'=>$this->generateUrl('empresas_index')
            'redirect' => 'termino'
        );
        return new JsonResponse($json);

    }
}
