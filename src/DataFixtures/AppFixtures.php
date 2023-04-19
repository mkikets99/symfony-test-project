<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasherInterface;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }
    public function load(ObjectManager $manager): void
    {
        // create 20 fixtures for User
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setName("user" . $i);
            $uph = $this->userPasswordHasherInterface->hashPassword($user, "password" . $i);
            $user->setPassword($uph);
            $user->setEmail("user" . $i . "@gmail.com");

            $manager->persist($user);
        }


        $manager->flush();
    }
}
