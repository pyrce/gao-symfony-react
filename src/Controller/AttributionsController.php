<?php

namespace App\Controller;

use App\Entity\Attributions;
use Attribute;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
class AttributionsController extends AbstractController
{
   

    /**
     * @Route("/attributions", name="attributions")
     */
    public function index(): Response
    {
        return $this->render('attributions/index.html.twig', [
            'controller_name' => 'AttributionsController',
        ]);
    }
       /**
     * @Route("/api/attributions/delete",methods={"POST"})
     * @param $request
     */
    public function delete(Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        $post_data = json_decode($request->getContent(), true);
        $id=$post_data["id"];
        $product = $entityManager->getRepository(Attributions::class)->find($id);
        $entityManager->remove($product);
        $entityManager->flush();
return new JsonResponse(["msg"=>"ok"]);
    }

      /**
     * @Route("/api/attributions/add",methods={"POST"})
     * @param $request
     */
    public function add(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $post_data = json_decode($request->getContent(),true);

        $poste = $this->getDoctrine()
        ->getRepository('App:Postes')   ->findOneById($post_data["pc"]);

        $client = $this->getDoctrine()
        ->getRepository('App:Clients')   ->findOneById($post_data["client"]);

        $attr=new Attributions();
        $attr->setPosteId( $poste);
        $attr->setHeure($post_data["heure"]);
        $attr->setClientId($client);
        $today = date("Y-m-d"); 
        $attr->setJour($today);
        $entityManager->persist($attr);
       
     $entityManager->flush();

        return new JsonResponse(["msg"=>"ok"]);
    }

}
