<?php

namespace App\DataFixtures;

use App\Entity\Hall;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HallFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $a1 = new Hall();
        $a1->setName('Grande Salle')
            ->setCapacity(1000)
            ->setAvailable('Disponnible')
            ->setConcertHall($this->getReference(ConcertHallFixture::Paloma_Salle));
        $manager->persist($a1);
        $manager->flush();
    }
}
