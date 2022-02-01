<?php

namespace App\Controller;

use Doctrine\DBAL\Driver\PDO\SQLSrv\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaController extends AbstractController
{
    /**
     * @Route("/categoria", name="categoria")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CategoriaController.php',
        ]);
    }

    /**
     * @Route("/categoria/create", name="categoria_create")
     */
    public function create(Connection $connection,Request $request){
        $connection->insert('categoria', ['categoria'=>$request->request->get('categoria'),'idImmagine'=>$request->request->get('idImmagine')]);
    }

}
