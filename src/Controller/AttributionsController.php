<?php

namespace App\Controller;

use App\Entity\Attributions;
use App\Repository\AttributionsRepository;
use App\Repository\ClientsRepository;
use App\Repository\PostesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
class AttributionsController extends AbstractController
{
   

    /**
     * @Route("/attributions", name="attributions")
     */
    public function index(Request $request, SerializerInterface $serializer, ClientsRepository $clientRepository, PostesRepository $computerRepository): JsonResponse
    {
        $data     = json_decode($request->getContent(), true);
        $client   = $clientRepository->find($data['clientId']);
        $computer = $computerRepository->find($data['desktopId']);

        $date = new \DateTime($data['date']);
        $attribution = new Attributions();
        $attribution->setHeure($data['hours']);
        $attribution->setJour($date);
        $attribution->setClient($client);
        $attribution->setPoste($computer);
        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->persist($attribution);
        $doctrine->flush();

        $responsJson = [
            "message" => "Créneau réservé",
            "content" => $attribution,
        ];

        $json = $serializer->serialize($responsJson, 'json', ['groups' => 'attrib']);
        $response = new JsonResponse($json, 200, [], true);
        return $response;
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
