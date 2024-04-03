<?php

namespace App\Controller;

use App\Form\LocationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionLocationController extends AbstractController
{
    #[Route('/gestion/location', name: 'app_gestion_location')]
    public function index(Request $request,  EntityManagerInterface $entityManager): Response
    {

      //  dump($request);

        $Form = $this->createForm(LocationType::class)->handleRequest($request);

        if ($Form->isSubmitted() && $Form->isValid()){

             //dump($Form->getData());

            $gestionLocationForm=  $Form->getData();


            $entityManager->persist($gestionLocationForm);

            $entityManager->flush();

            $this->addFlash(
                'ma-variable',
                'Your changes have been saved with sucess!'
            );

            return $this->redirectToRoute("app_gestion_location");


        }


            //   exit;

        return $this->render('gestion_location/index.html.twig', [
            'controller_name' => 'GestionLocationController',
            'gestionLocationForm'=>$Form->createView()
        ]);
    }
}
