<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Guest;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $guest = new Guest();
        $user->setEmail('test@email.com');
        $user->setRoles([]);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'testpassword'));
        $guest->setFirstName('Test');
        $guest->setLastName('User');
        $guest->setEmail($user->getEmail());
        $user->setGuestId($guest);
        $manager->persist($user);
        $manager->flush();

        $this->addReference('user', $user);
    }
}


