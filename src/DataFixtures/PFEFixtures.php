<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PFEFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for($i = 0 ; $i< 100 ; $i++) {
            $repo = $manager->getRepository(\App\Entity\Entreprise::class);
            $entreprise =$repo->findOneBy(['designation'=>"entreprise$i"], []);
            $pfe = new \App\Entity\PFE();
            $pfe->setNomEtudiant($faker->name);
            $pfe->setEntreprise($entreprise);
            $manager->persist($pfe);
        }
        $manager->flush();
    }
}
