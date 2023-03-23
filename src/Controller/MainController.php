<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Article\Article;
use App\Model\Page;
use Knp\Component\Pager\PaginatorInterface;
use Stenope\Bundle\ContentManagerInterface;
use Stenope\Bundle\Exception\ContentNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class MainController extends AbstractController
{
    public const RSS_LIMIT_PER_PAGE = 10;

    #[Route('/', name: 'home', defaults: [
        'page' => '1',
        '_format' => 'html',
        '_locale' => 'en',
    ], methods: ['GET'])]
    public function home(string $_locale, string $_format): Response
    {
        return $this->render('pages/index.' . $_format . '.twig', [
            '_locale' => $_locale,
        ]);
    }

    #[Route('/rss.xml', name: 'app_rss', defaults: [
        'page' => '1',
        '_format' => 'xml',
    ], methods: ['GET'])]
    public function rss(int $page, string $_format, PaginatorInterface $paginator, ContentManagerInterface $manager, Request $request): Response
    {
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
            self::RSS_LIMIT_PER_PAGE /* limit per page */
        );
        return $this->render('pages/index.' . $_format . '.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * This route is used to display pages from `content/pages`.
     * Since this is a catch-all route, it has a very low priority.
     */
    #[Route('/{slug}', name: 'page', requirements: [
        'slug' => '[^\.]+',
    ], priority: -500)]
    public function page(string $slug, ContentManagerInterface $contentManager, Environment $twig): Response
    {
        try {
            $page = $contentManager->getContent(Page::class, $slug);
        } catch (ContentNotFoundException $exception) {
            throw $this->createNotFoundException(sprintf(
                'Page not found. Did you forget to create a `content/pages/%s.md/html` file?',
                $slug,
            ), $exception);
        }

        // You can create a custom template for each page, named after its slug,
        // (e.g: For "foo/bar.md" file => use "foo/bar.html.twig")
        // or use the generic "page.html.twig" one.
        $template = "{$slug}.html.twig";
        if (! $twig->getLoader()->exists($template)) {
            $template = 'page.html.twig';
        }

        return $this->render($template, [
            'page' => $page,
        ]);
    }
}
