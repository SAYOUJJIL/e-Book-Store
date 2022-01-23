<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
     {
         $this->passwordHasher = $passwordHasher;
     }
    public function load(ObjectManager $manager): void
    {
        
        $faker = \Faker\Factory::create('fr_FR');
        $email = $faker->email;
        $roles[] = 'ROLE_ADMIN';
        $password = $faker->password();
        $user = new User();
        $user->setEmail($email);
        $user->setRoles($roles);
        $user->setPassword($this->passwordHasher->hashPassword($user,$password));
        $manager->persist($user);
        $manager->flush();
    }
}
