<?php

namespace App\DataFixtures;

use App\Entity\ConcertHall;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ConcertHallFixture extends Fixture
{
    public const Paloma_Salle = 'paloma';
    public function load(ObjectManager $manager)
    {

        $a1 = new ConcertHall();
        $a1->setName('Paloma')
            ->setTotalPlaces(1500)
            ->setPresentation('Salle de concert nimoise')
            ->setCity('Nîmes');
        $manager->persist($a1);
        $this->addReference(self::Paloma_Salle, $a1);
        $manager->flush();
    }
}
