<?php

namespace App\Controller;

use DateTime;
use App\Entity\Attributions;
use App\Entity\Postes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Query;
use Serializable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PostesRepository;
use Symfony\Component\Serializer\SerializerInterface;
class PostesController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function liste()
    {
        
        return $this->render('base.html.twig');
    }
       /**
     * @Route("/api/postes", name="getPostes",methods={"GET"})
     */
public function getPostes(PostesRepository $post,Request $request,SerializerInterface $serializer): JsonResponse{

    $page      = $request->query->get('page') ? (int) $request->query->get('page') : 1;
    $datenow   = new DateTime();
    $dateQuery = $datenow->format('Y-m-d');
    $date      = $request->query->get('date') ? $request->query->get('date') : $dateQuery;

    // let's see getAssigns from Computer entity
    $computers = new Postes();
   // $computers::$date = $date;

    $computersQuery = $post->findAllQuery();
    $limit = 3;

    // $computerPaginate = $paginatorInterface->paginate(
    //     $computersQuery,  // Les données à paginé
    //     $page,            // Numéro de la page
    //     $limit            // Nombre d'élément par page
    // );

    $totalComputers = $post->findAllAndCount();
    $data = [
       // 'data'      => $computerPaginate,
        //'totalpage' => ceil($totalComputers / $limit),
       $computersQuery
    ];


    $json = $serializer->serialize($data, 'json', ['groups' => 'attribution']);
    $response = new JsonResponse($json, 200, []);

    return $response;
}
     /**
     * @Route("/postes/add", name="attr")
     */
    public function add(Request $request) 
    {
      $entityManager = $this->getDoctrine()->getManager();
      $post_data = json_decode($request->getContent(),true);

      $postes=new Postes();
      $postes->setNomPoste($post_data["nomPoste"]);
      $entityManager->persist($postes);    
     $entityManager->flush();
        return new JsonResponse("ok");


    }
}
