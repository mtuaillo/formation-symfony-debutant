<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @return Article[]
     */
    public function findAllWithTitleContaining(string $search): array
    {
        return $this->createQueryBuilder('article')
            ->andWhere('article.title LIKE :title')
            ->setParameter('title', "%{$search}%")
            ->orderBy('article.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}
