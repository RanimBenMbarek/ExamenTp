<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EntrepriseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0 ; $i< 100 ; $i++) {
            $entreprise= new Entreprise();
            $entreprise->setDesignation("entreprise".$i);
            $manager->persist($entreprise);
        }
        $manager->flush();
}
}
