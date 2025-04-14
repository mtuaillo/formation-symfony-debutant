<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppArticles extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $article = new Article();
        $article
            ->setTitle('PHP Basics')
            ->setContent('content')
            ->setSlug('php-basics')
            ->setAuthor(
                $this->getReference(AppUsers::USER_TEST_1)
            )
            ->addTag(
                $this->getReference(AppTags::TAG_PHP)
            )
        ;

        $manager->persist($article);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AppTags::class,
            AppUsers::class,
        ];
    }
}
