<?php

namespace App\Controller\Api\Articles;

use App\Entity\Article;
use App\Entity\User;
use App\Services\Article\ArticleManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateController extends AbstractController
{
    public function __construct(
        private readonly ValidatorInterface $validator,
        private readonly ArticleManager $articleManager,
        private readonly SerializerInterface $serializer,
    ) {
    }

    /**
     * curl https://127.0.0.1:8000/api/articles/create \
     * --request POST \
     * --cookie "PHPSESSID=2ucknn7xot305au282" \
     * --header "Content-Type: application/json" \
     * --data '{"content": "contenu", "title": "titre"}'
     */
    #[Route('/api/articles/create', name: 'api_articles_create', methods: ['POST'])]
    public function create(
        Request $request,
        #[CurrentUser] User $currentUser
    ): JsonResponse {
        $article = new Article();
        $article
            ->setContent($request->getPayload()->get('content', ''))
            ->setTitle($request->getPayload()->get('title', ''))
        ;

        $constraintViolationList = $this->validator->validate($article);
        if (count($constraintViolationList) > 0) {
            return new JsonResponse($constraintViolationList, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $this->articleManager->create($article, $currentUser);

        return JsonResponse::fromJsonString(
            $this->serializer->serialize($article, 'json')
        );
    }
}
