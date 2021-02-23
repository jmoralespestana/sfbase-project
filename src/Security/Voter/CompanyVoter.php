<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Security;

class CompanyVoter extends Voter
{
    private $security = null;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        $permissions = [];

        for ($i = 0; $i < 5; $i++) {

            $permissions[] = 'ROLE_MODULE' . $i . '_BLACK';
            $permissions[] = 'ROLE_MODULE' . $i . '_GOLD';
            $permissions[] = 'ROLE_MODULE' . $i . '_VIP';
            $permissions[] = 'ROLE_MODULE' . $i . '_PLATINUM';

        }

        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, $permissions)
            && $subject instanceof \App\Entity\Company;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        if ($this->security->isGranted('ROLE_SUPER_ADMIN') || in_array($attribute, $user->getRoles())) {
            return true;
        }

        return false;
    }
}
