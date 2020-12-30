<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PictureFixture extends Fixture
{
    public const PICTURE_PM = 'photo PM';
    public const PICTURE_TOP = 'photo TOP';
    public const PICTURE_ty = 'photo tyler';
    public const PICTURE_josh = 'photo joshua';

    public function load(ObjectManager $manager)
    {

        $a1 = new Picture();
        $a1->setName('postmalone')
            ->setAlternativeName('pm_img')
            ->setUrl('./images/pm.jpeg');
        $manager->persist($a1);

        $a2 = new Picture();
        $a2->setName('Twenty One Pilots')
            ->setAlternativeName('top_img')
            ->setUrl('./images/top.jpg');
        $manager->persist($a2);

        $a3 = new Picture();
        $a3->setName('Tyler')
            ->setAlternativeName('ty_img')
            ->setUrl('./images/tyler.jpg');
        $manager->persist($a3);

        $a4 = new Picture();
        $a4->setName('Joshua')
            ->setAlternativeName('josh_img')
            ->setUrl('./images/joshua.jpg');
        $manager->persist($a4);

        $manager->flush();

        $this->addReference(self::PICTURE_PM, $a1);
        $this->addReference(self::PICTURE_TOP, $a2);
        $this->addReference(self::PICTURE_ty, $a3);
        $this->addReference(self::PICTURE_josh, $a4);
    }
}
