<?php

namespace App\Controller\Web\Articles;

use App\Entity\Article;
use App\Form\CreateArticleType;
use App\Security\Voter\ArticleEditVoter;
use App\Services\Article\ArticleManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EditController extends AbstractController
{
    public function __construct(
        private ArticleManager $articleManager,
    ) {
    }

    #[Route('/articles/edit/{id}', name: 'articles_edit', methods: ['GET', 'POST'])]
    #[IsGranted(ArticleEditVoter::EDIT, 'article')]
    public function edit(
        Request $request,
        Article $article,
    ): Response {
        $form = $this->createForm(CreateArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            $this->articleManager->edit($article);

            return $this->redirectToRoute('articles_list');
        }

        dump($form->getErrors());

        return $this->render('web/articles/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
