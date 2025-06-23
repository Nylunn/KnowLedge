<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class isVerified extends Voter
{
    protected function supports(string $attribute, $subject): bool
    {
        // Defined an attribute is verified to know if the user if verified or not
        return $attribute === 'IS_VERIFIED';
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // if the user is not connected he will be rejected
        if (!$user instanceof User) {
            return false;
        }

        // verification if the user if verified
        return $user->isVerified();
    }

    
}
