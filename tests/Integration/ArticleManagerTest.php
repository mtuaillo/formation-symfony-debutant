<?php

namespace App\Tests\Integration;

use App\Entity\Article;
use App\Repository\UserRepository;
use App\Services\Article\ArticleManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArticleManagerTest extends KernelTestCase
{
    public function testCreate(): void
    {
        // Arrange
        $articleManager = static::getContainer()->get(ArticleManager::class);
        $userRepository = static::getContainer()->get(UserRepository::class);

        $user = $userRepository->findOneByEmail('test1@test.dev');

        // Act
        $article = new Article();
        $article
            ->setTitle('Article deux')
            ->setContent('Lorem ipsum');

        $articleManager->create($article, $user);

        // Assert
        $this->assertIsInt($article->getId());
        $this->assertIsString($article->getSlug());
    }
}
