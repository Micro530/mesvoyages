<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AcceuilController
 *
 * @author quens
 */
class AcceuilController {
    /**
     * @Route("/", name="accueil")
     * @return Response
     */
    public function index ():Response{
        return new Response("Helle World !");
    }
        
    
}
