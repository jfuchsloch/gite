<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\AccessTokenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{

   /* public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiLoginController.php',
        ]);
    }*/

    #[Route('/api/login', name: 'api_login')]
    public function index(#[CurrentUser] ?User $user, AccessTokenRepository $accessTokenRepository): Response
    {
       //dump ($user);
        // exit;

                if (null === $user) {
                     return $this->json([
                             'message' => 'missing credentials',
                         ], Response::HTTP_UNAUTHORIZED);
         }

         //$token ="test"; // somehow create an API token for $user
        $accessToken =$accessTokenRepository->findOneByUser($user);

          return $this->json([
                           'message' => 'Welcome to your new controller!',
                           'path' => 'src/Controller/ApiLoginController.php',
                           'user'  => $user->getUserIdentifier(),
                           'token' => $accessToken->getValue(),
          ]);
      }
}
