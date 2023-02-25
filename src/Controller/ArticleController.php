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
    public const LIMIT_PER_PAGE = 5;

    #[Route('/{page}', name: 'app_article_list', requirements: [
        'page' => '\d+',
    ], defaults: [
        'page' => '1',
    ], priority: -200)]
    public function list(
        int $page,
        PaginatorInterface $paginator,
        ContentManagerInterface $manager,
        Request $request
    ): Response {
        $locale = $request->getLocale();
        $articles = $manager->getContents(
            Article::class,
            [
                'publishedAt' => false,
            ],
            function (Article $article) use ($locale): bool {
                return $article->isPublished() && $article->lang === $locale;
            }
        );

        $pagination = $paginator->paginate(
            $articles, /* query NOT result */
            $page, /* page number */
            self::LIMIT_PER_PAGE /* limit per page */
        );

        $response = $this->render('pages/articles/list.html.twig', [
            'pagination' => $pagination,
        ]);
        if (! empty($articles)) {
            $response->setLastModified(ContentUtils::max($articles, 'lastModifiedOrCreated'));
        }

        return $response;
    }

    #[Route('/{article}', name: 'app_article_show', requirements: [
        'article' => '.+',
    ], priority: -201)]
    public function show(Article $article): Response
    {
        return $this->render('pages/articles/show.html.twig', [
            'article' => $article,
        ])->setLastModified($article->getLastModifiedOrCreated());
    }
}
