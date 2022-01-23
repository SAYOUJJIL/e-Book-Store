<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Auteur;

class AuteurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        //20 auteurs 
        for ($i = 0; $i < 20; $i++) {
            $nom_prenom =  $faker->name;    
            $sexe = $faker->randomElement(['F','H']);;
            $date_de_naissance = $faker->dateTimeBetween();
            $nationalite = $faker->country;
            $auteur = new Auteur();
            $auteur->setNomPrenom($nom_prenom);
            $auteur->setSexe($sexe);
            $auteur->setDateDeNaissance($date_de_naissance);
            $auteur->setNationalite($nationalite);
            $manager->persist($auteur);
            
        }
        $manager->flush();
    }
}
