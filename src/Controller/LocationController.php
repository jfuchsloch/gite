<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocationController extends AbstractController
{
    #[Route('/location/{id}', name: 'app_location')]
    public function index(Location $location, Request $request, EntityManagerInterface $entityManager): Response
    {
        dump($location);

        dump($request);
      //  exit;

        $reservationForm = $this->createForm(ReservationType::class)->handleRequest($request);


        if ($reservationForm->isSubmitted() && $reservationForm->isValid()){

           // dd($reservationForm->getData());

            $disponibilite = $reservationForm->getData();

            $disponibilite->setLocation($location);

            $entityManager->persist($disponibilite);

            $entityManager->flush();

            $this->addFlash(
                'ma-variable',
                'Your changes have been saved with sucess!'
            );

           //dd($disponibilite);

            return $this->redirectToRoute("app_location", ["id"=>$location->getId()]);


        }

        return $this->render('location/index.html.twig', [
            'location' => $location,
            'reservationForm'=>$reservationForm->createView()
        ]);
    }
}
