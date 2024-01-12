<?php

namespace App\Service;

use App\Repository\ArticleRepository;
use Psr\Log\LoggerInterface;

class ArticleService implements ArticleServiceInterface
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
        private readonly LoggerInterface $logger,
    )
    {

    }
//создали слой промежуточный между контроллером и слоем доступа данных
//бизнес логика
    public function getRecentArticles(int $count, ?string $search = null): \Doctrine\ORM\Query
    {
        $this->logger->info(sprintf('getting %d recent articles', $count));
        //здесь может быть кеш, здесь может быть математика
        return $this->articleRepository->getRecentArticles($count, $search);
    }
}

//это нужно для того, чтобы развязать логику, чтоб можно было заменить слой ниже, чем бизнес логика