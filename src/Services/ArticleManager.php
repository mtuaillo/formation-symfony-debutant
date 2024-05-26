<?php

namespace App\Services;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class ArticleManager
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function create(Article $article): Article
    {
        $this->entityManager->persist($article);
        $this->entityManager->flush();

        return $article;
    }

    public function edit(Article $article): Article
    {
        // TODO: mettre à jour le slug
        // TODO: mettre à jour la dernière date d'édition

        $this->entityManager->flush();
    }
}