<?php


namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserInformation
{
    private $manager;

    /**
     * UserInformation constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getInfo($user): array
    {
        $info = [];

        $user = $this->manager->getRepository(User::class)->findOneByUsername($user->getUsername());

        $info['user'] = $this->getUserInfo($user);

        return $info;
    }

    private function getUserInfo(User $user): array
    {
        $userInfo = [];
        $userInfo['username'] = $user->getUsername();
        $userInfo['company'] = $user->getCompany()->getName();
        $userInfo['roles'] = $user->getRoles();

        return $userInfo;
    }
}