<?php

namespace App\Controller\Api;


use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiLocationController extends AbstractController
{
    #[Route('/api/location', name: 'app_api_location')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
         dump($request);

        // exit;


        //dump($request->request->get("title"));
       //dd($request->request);
// Init tab
        $location = new Location();

        $location->setTitle($request->request->get("title"));

        $location->setDescription($request->request->get("description"));

        $entityManager->persist($location);

        $entityManager->flush();



        return $this->json(["message"=>"votre location a ete bien ajouté"]);

    }
}
