<?php

namespace App\Tests\Unit;

use App\Entity\Article;
use App\Services\Article\ArticleStatus;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function testPublish(): void
    {
        $article = new Article();
        $this->assertEquals(ArticleStatus::DRAFT, $article->getStatus());

        $article->publish();
        $this->assertEquals(ArticleStatus::PUBLISHED, $article->getStatus());
    }
}
