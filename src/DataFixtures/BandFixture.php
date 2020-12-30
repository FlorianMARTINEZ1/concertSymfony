<?php

namespace App\DataFixtures;

use App\Entity\Band;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BandFixture extends Fixture implements DependentFixtureInterface
{
    public const TOP_BAND = 'TOP';
    public const PM_BAND = 'PM';

    public function load(ObjectManager $manager)
    {
        $a1 = new Band();
        $a1->setName('Post Malone')
            ->setStyle('Hip Hop')
            ->setYearOfCreation(\DateTime::createFromFormat("Y", '2013'))
            ->setLastAlbumName('Hollywood\'s Bleeding')
            ->setPicture($this->getReference(PictureFixture::PICTURE_PM));
        $manager->persist($a1);

        $a2 = new Band();
        $a2->setName('Twenty One Pilots')
            ->setStyle('Hip Hop')
            ->setYearOfCreation(\DateTime::createFromFormat("Y", '2011'))
            ->setLastAlbumName('Trench')
            ->setPicture($this->getReference(PictureFixture::PICTURE_TOP));
        $manager->persist($a2);

        $manager->flush();

        $this->addReference(self::PM_BAND, $a1);
        $this->addReference(self::TOP_BAND, $a2);
    }

    public function getDependencies()
    {
        return array(
            PictureFixture::class
        );
    }
}
