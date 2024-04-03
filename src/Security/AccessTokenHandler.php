<?php

namespace App\Security;

use App\Repository\AccessTokenRepository;
use Symfony\Component\Security\Http\AccessToken\AccessTokenHandlerInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class AccessTokenHandler implements AccessTokenHandlerInterface
{
    public function __construct(
        private AccessTokenRepository $repository
    )
    {
    }

    public function getUserBadgeFrom(string $accessToken): UserBadge
    {
       // var_dump("getUserBadgeFrom");
       // dd("test");

       // exit;

// e.g. query the "access token" database to search for this token
        $accessToken = $this->repository->findOneByValue($accessToken);
        if (null === $accessToken || !$accessToken->isValid()) {
            throw new BadCredentialsException('Invalid credentials.');
        }

// and return a UserBadge object containing the user identifier from the found token
        //return new UserBadge($accessToken->getUserId());
        return new UserBadge($accessToken->getUser()->getUserIdentifier());
    }
}