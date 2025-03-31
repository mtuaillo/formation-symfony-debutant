<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppTags extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tag1 = new Tag();
        $tag1->setName('php');
        $manager->persist($tag1);

        $tag2 = new Tag();
        $tag2->setName('python');
        $manager->persist($tag2);

        $tag3 = new Tag();
        $tag3->setName('ruby');
        $manager->persist($tag3);

        $tag4 = new Tag();
        $tag4->setName('javascript');
        $manager->persist($tag4);

        $manager->flush();
    }
}
