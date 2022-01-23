<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Genre;

class GenreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        
        // créer 10 genres

        for ($i = 0; $i < 10; $i++) {
            $nom = $faker->word();     
            $genre = new Genre();
            $genre->setNom($nom);
            $manager->persist($genre);
            
        }

        $manager->flush();
    }
}
