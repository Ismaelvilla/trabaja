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
        $repositoryProvincia = $entityManager->getRepository('WebManagementBundle:Provincias');
        $provincias = $repositoryProvincia->findAll();

        //vamos a sacar los municipios
        $repositoryMunicipio = $entityManager->getRepository('WebManagementBundle:Municipios');
        $municipios = $repositoryMunicipio->findAll();

        //vamos a sacar las categorias
        $repositoryCategoria = $entityManager->getRepository('WebManagementBundle:Categoria');
        $categorias = $repositoryCategoria->findAll();

        echo "el id de empresa es: ".$idEmpresa;
        return $this->render('WebManagementBundle:Empresa:details.html.twig',
            array(
                'empresa' => $empresa,
                'provincias' => $provincias,
                'municipios' => $municipios,
                'categorias' => $categorias
            ));
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

        $csr_token = $request->request->get('_csrf_token');
        $data = $request->request->all();

        //buscamos la empresa
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryEmpresa = $entityManager->getRepository('WebManagementBundle:Empresa');
        $empresa = $repositoryEmpresa->find($data['id']);
        $empresas = $repositoryEmpresa->findAll();

        //buscamos la categoria
        $repositoryCategoria = $entityManager->getRepository('WebManagementBundle:Categoria');
        $categoria = $repositoryCategoria->find($data['categoria']);

        if ($this->isCsrfTokenValid('edit_notification', $csr_token)) {

            $empresa->setNombre($data['nombre']);
            $empresa->setCategoria($categoria);
            $empresa->setProvincia($data['provincia']);
            $empresa->setPoblacion($data['poblacion']);
            $empresa->setEmail($data['email']);
            $empresa->setPrioridad($data['prioridad']);
            $entityManager->flush();
        }

        return $this->render('WebManagementBundle:Empresa:index.html.twig', array('empresas'=>$empresas));


       /* echo "hasta qui ".$data['categoria'];
        die();*/
      /*  $json = array(
           // 'redirect'=>$this->generateUrl('empresas_index')
            'redirect' => 'termino'
        );
        return new JsonResponse($json);*/

    }

    public function provinciaAjaxAction(Request $request){
        $idProvincia = $request->query->get('idProvincia');

        //vamos a sacar todos los municipios que tiene esta provincia
        $entityManager = $this->getDoctrine()->getManager();
        //vamos a sacar los municipios
        $repositoryMunicipio = $entityManager->getRepository('WebManagementBundle:Municipios');
        $municipios = $repositoryMunicipio->getMunicipiosProvincia($entityManager, $idProvincia);

       /* $json = array(
            'respuesta' => $idProvincia
        );
        return new JsonResponse($json);*/
        $response = $this->render('WebManagementBundle:Empresa:cajaMunicipio.html.twig', array(
            'municipios' => $municipios
        ));

        return $response;
        /*return $this->render('WebManagementBundle:Empresa:cajaMunicipio.html.twig',
            array(
                  'municipios' => $municipios
            ));*/
    }

    public function pruebasAction(){
        //vamos a probar los municipios
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryMunicipios = $entityManager->getRepository('WebManagementBundle:Municipios');
        $municipios = $repositoryMunicipios->getMunicipiosProvincia($entityManager,6);

        return $this->render('WebManagementBundle:Empresa:pruebas.html.twig', array('municipios'=>$municipios));
    }
}
