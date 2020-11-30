<?php

namespace App\Controller;

use App\Entity\Attributions;
use App\Entity\Postes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/api/postes", name="postes")
     */
public function getPostes(Request $request){

     // $post_data = json_decode($request->getContent(),true);
     $post_data=$request->get("date");

  $postes = $this->getDoctrine()
        ->getRepository('App:Postes')   -> findAllPostes($post_data);
  
  
$i=0;
$j=0;

          $attr=array();   
    foreach ($postes as $p) {

     $t= array_filter($attr, function  ($v,$k) use (&$p) {
if(isset($v["nomPoste"])){
        if($v["nomPoste"]==$p["p_nomPoste"]){ return $v;}
}
        },ARRAY_FILTER_USE_BOTH);  

     if (sizeof($t)>0) {
        // if($attr[$i]["nomPoste"]==$p["p_nomPoste"]){

        // $attr[$i]=array();

        if (sizeof($t[$i]["attributions"])>0) {

          $j++;
          
          $t[$i]["attributions"][$j]["id"] = $p["a_id"];
          $attr[$i]["attributions"][$j]["posteId"] = $p["p_id"];
          $t[$i]["attributions"][$j]["nom_client"] = $p["c_nomClient"];
          $t[$i]["attributions"][$j]["prenom_client"] = $p["c_prenomClient"];
          $t[$i]["attributions"][$j]["heure"] = $p["a_heure"];
          $t[$i]["attributions"][$j]["jour"] = $p["a_jour"];
          $attr[$i]=$t[$i];
        } else {
    
          $attr[$i]["attributions"][$j]["id"] = $p["a_id"];
          $attr[$i]["attributions"][$j]["posteId"] = $p["p_id"];
          $attr[$i]["attributions"][$j]["nom_client"] = $p["c_nomClient"];
          $attr[$i]["attributions"][$j]["prenom_client"] = $p["c_prenomClient"];
          $attr[$i]["attributions"][$j]["heure"] = $p["a_heure"];
          $attr[$i]["attributions"][$j]["jour"] = $p["a_jour"];
        } 
     
  // $j++;
      } else {
        $i++;
        $attr[$i]["id"] = $p["p_id"];
        $attr[$i]["nomPoste"] = $p["p_nomPoste"]; 

        if( isset($p["a_id"]) ){
          $j=0;
        $attr[$i]["attributions"][$j]["id"] = $p["a_id"];
        $attr[$i]["attributions"][$j]["posteId"] = $p["p_id"];
        $attr[$i]["attributions"][$j]["nom_client"] = $p["c_nomClient"];
        $attr[$i]["attributions"][$j]["prenom_client"] = $p["c_prenomClient"];
        $attr[$i]["attributions"][$j]["heure"] = $p["a_heure"];
        $attr[$i]["attributions"][$j]["jour"] = $p["a_jour"];
        }
      }

     
        }

        return new JsonResponse($attr);
}
     /**
     * @Route("/api/postes/add", name="attr")
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
