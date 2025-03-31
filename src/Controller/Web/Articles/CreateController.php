<?php

namespace App\Controller\Web\Articles;

use App\Entity\User;
use App\Form\CreateArticleType;
use App\Services\Article\ArticleManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class CreateController extends AbstractController
{
    public function __construct(
        private ArticleManager $articleManager,
    ) {
    }

    #[Route('/articles/create', name: 'articles_create', methods: ['GET', 'POST'])]
    public function create(
        Request $request,
        #[CurrentUser] User $currentUser
    ): Response {
        $form = $this->createForm(CreateArticleType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            $this->articleManager->create($article, $currentUser);

            return $this->redirectToRoute('articles_list');
        }

        return $this->render('web/articles/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
