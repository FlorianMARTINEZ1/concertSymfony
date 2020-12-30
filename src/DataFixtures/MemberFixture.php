<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Member;

class MemberFixture extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $a1 = new Member();
        $a1->setName('Austin')
            ->setFirstName('Post')
            ->setJob('Rappeur')
            ->setBirthDate(\DateTime::createFromFormat("d/m/Y", '04/07/1995'))
            ->setPicture($this->getReference(PictureFixture::PICTURE_PM))
            ->setBand($this->getReference(BandFixture::PM_BAND));
        $manager->persist($a1);

        $a2 = new Member();
        $a2->setName('Tyler')
            ->setFirstName('Joseph')
            ->setJob('Chanteur')
            ->setBirthDate(\DateTime::createFromFormat("d/m/Y", '01/12/1988'))
            ->setPicture($this->getReference(PictureFixture::PICTURE_ty))
            ->setBand($this->getReference(BandFixture::TOP_BAND));
        $manager->persist($a2);

        $a3 = new Member();
        $a3->setName('Joshua')
            ->setFirstName('Dun')
            ->setJob('Musicien')
            ->setBirthDate(\DateTime::createFromFormat("d/m/Y", '18/06/1988'))
            ->setPicture($this->getReference(PictureFixture::PICTURE_josh))
            ->setBand($this->getReference(BandFixture::TOP_BAND));
        $manager->persist($a3);

        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            PictureFixture::class,
            BandFixture::class
        );
    }
}
