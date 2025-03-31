<?php

namespace App\Tests\Unit;

use App\Entity\Article;
use App\Entity\User;
use App\Services\Article\ArticleManager;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;

class ArticleManagerTest extends TestCase
{
    public function testCreate(): void
    {
        // Arrange
        $entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $entityManagerMock
            ->expects($this->once())
            ->method('persist');
        $entityManagerMock
            ->expects($this->once())
            ->method('flush');

        $articleManager = new ArticleManager($entityManagerMock);

        // Act
        $article = new Article();
        $article
            ->setTitle('Article un')
            ->setContent('Lorem ipsum');

        $articleManager->create($article, new User());

        // Assert
        $this->assertEquals('article-un', $article->getSlug());
    }
}
