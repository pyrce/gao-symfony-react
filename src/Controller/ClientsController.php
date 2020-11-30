<?php

namespace App\Controller;

use App\Entity\Clients;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;

class ClientsController extends AbstractController
{
    /**
     * @Route("/clients", name="clients")
     */
    public function index(): Response
    {
        $user = $this->getUser();
      
        //$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $clients= $this->getDoctrine()
        ->getRepository('App:Clients')   -> findAll();
        return new JsonResponse($clients);
    }

    public function add(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $post_data = json_decode($request->getContent(),true);

        $attr=new Clients();
        $attr->setNomClient( $post_data["nomClient"]);
        $attr->setPrenomClient($post_data["prenomClient"]);
        $entityManager->persist($attr);
       
        $entityManager->flush();

        return new JsonResponse(["msg"=>"ok"]);
    }
}
