<?php

namespace App\Services\Article;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;

class ArticleManager
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function create(Article $article, User $user): Article
    {
        $article->setAuthor($user);

        $slugger = new AsciiSlugger();
        $article->setSlug(
            $slugger->slug($article->getTitle())
        );

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
