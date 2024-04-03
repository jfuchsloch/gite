<?php

namespace App\Controller;


use App\Entity\Location;
use App\Form\ContactType;
use App\Message\ContactNotification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
       $locations =  $entityManager->getRepository(Location::class)->findAll();

       dump($locations);


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'locations' => $locations,
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MessageBusInterface $bus): Response
    {

        $Form = $this->createForm(ContactType::class)->handleRequest($request);

        if ($Form->isSubmitted() && $Form->isValid()){

            //dump($Form->getData());

        //   sleep(5);
            $bus->dispatch(new ContactNotification('Look! I created a message!'));

            return $this->redirectToRoute("app_contact");

        }


        return $this->render('home/contact.html.twig', [
            'contactForm'=>$Form->createView()
        ]);
    }

    #[Route('/contact-api-vue', name: 'app_contact_api_vue')]
    public function contactApiVue(Request $request, MessageBusInterface $bus): Response
    {
    // dump($request);

       // $bus->dispatch(new ContactNotification('Look! I created a message!'));

        $bus->dispatch(new ContactNotification($request->request->get('title')));


         return $this->json([
        'message' => 'ok',
          ]);
    }

}
