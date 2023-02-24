<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Article\Article;
use Knp\Component\Pager\PaginatorInterface;
use Stenope\Bundle\ContentManagerInterface;
use Stenope\Bundle\Service\ContentUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/articles')]
class ArticleController extends AbstractController
{
    public function __construct(private readonly ContentManagerInterface $manager)
    {
    }

    #[Route('/', name: 'app_article_list', priority: -200)]
    public function list(PaginatorInterface $paginator, Request $request): Response
    {
        $articles = $this->manager->getContents(Article::class, ['publishedAt' => false], '_.isPublished()');

        $pagination = $paginator->paginate(
            $articles, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );

        return $this->render('pages/articles/list.html.twig', [
            'pagination' => $pagination
        ])->setLastModified(ContentUtils::max($articles, 'lastModifiedOrCreated'));
    }

    #[Route('/{article}', name: 'app_article_show', requirements: ['article' => '.+'])]
    public function show(Article $article): Response
    {
        return $this->render('pages/articles/show.html.twig', [
            'article' => $article,
        ])->setLastModified($article->getLastModifiedOrCreated());
    }
}
