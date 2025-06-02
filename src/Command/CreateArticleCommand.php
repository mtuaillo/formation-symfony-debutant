<?php

namespace App\Command;

use App\Entity\Article;
use App\Repository\UserRepository;
use App\Services\Article\ArticleManager;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:articles:create',
    description: 'Create a new article',
)]
class CreateArticleCommand extends Command
{
    public function __construct(
        private readonly ArticleManager $articleManager,
        private readonly UserRepository $userRepository,
    ) {
        parent::__construct();
    }

    public function __invoke(
        SymfonyStyle $io,
        #[Argument] string $title,
        #[Argument] string $content,
        #[Argument] string $email,
    ): int {
        try {
            $author = $this->userRepository->findOneBy(['email' => $email]);

            $article = new Article();
            $article
                ->setTitle($title)
                ->setContent($content);

            $this->articleManager->create($article, $author);

            $io->success('Article créé avec succès !');
        } catch (\Exception $exception) {
            dump($exception);
        }

        return Command::SUCCESS;
    }
}
