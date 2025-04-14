<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppUsers extends Fixture
{
    public const USER_TEST_1 = 'user-test-1';

    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('test1@test.dev');
        $password = $this->passwordHasher->hashPassword($user1, 'Password1!');
        $user1->setPassword($password);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('test2@test.dev');
        $password = $this->passwordHasher->hashPassword($user2, 'Password2?');
        $user2->setPassword($password);
        $manager->persist($user2);

        $manager->flush();

        $this->addReference(self::USER_TEST_1, $user1);
    }
}
