<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Livre;
use App\Entity\Auteur;
use App\Entity\Genre;

class LivreFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        /*
        50 livres écrits par un à trois auteurs parmi les auteurs inscrits et appartenant à
        un à trois genres parmi les genres enregistrés. Ces livres sont publiés entre 1900
        et 2021 et ont une note entre 0 et 20*/

        $faker = \Faker\Factory::create('fr_FR');
        $auteurs = $manager->getRepository(Auteur::class)->findAll();
        $genres = $manager->getRepository(Genre::class)->findAll();
        for ($i = 0; $i < 50; $i++) 
        {
            $isbn =  $faker->isbn13;    
            $titre = $faker->words($faker->numberBetween(1, 3), true);
            $nombre_pages = $faker->randomNumber();
            $date_de_parution = $faker->dateTimeBetween('-121 years','now');
            $note = $faker->numberBetween(0, 20);   
            $livre = new Livre();
            $livre->setIsbn($isbn);
            $livre->setTitre($titre);
            $livre->setNombrePages($nombre_pages);
            $livre->setDateDeParution($date_de_parution);
            $livre->setNote($note);
            $livre->addAuteur($faker->randomElement($auteurs));
            $livre->addGenre($faker->randomElement($genres));
            $manager->persist($livre);   
        }
        $manager->flush();
    }
}
