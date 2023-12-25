<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Service\ArticleServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contrcts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    private const RECENT_ARTICLE_COUNT_ON_HOME = 5;
    
    #[Route('/', name: 'homepage')]

    public function index(ArticleServiceInterface $articleService, HttpClientInterface $httpClient): Response
    {
        $httpClient->request('GET', 'http://example.com/handle', [])->getContent(false);
        // REST
        // SOAP
        // gRPC ...
        return $this->render('home/index.html.twig', [
            'articles' => $articleService->getRecentArticles(self::RECENT_ARTICLE_COUNT_ON_HOME),
        ]);
    }
}
