<?php

namespace App\Controller\Api\Articles;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ShowController extends AbstractController
{
    public function __construct(
        private readonly SerializerInterface $serializer,
    ) {
    }

    #[Route('/api/articles/show/{id}', name: 'api_articles_show', methods: ['GET'])]
    public function show(Article $article): JsonResponse
    {
        return JsonResponse::fromJsonString(
            $this->serializer->serialize($article, 'json')
        );
    }
}
