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
    public function __construct(
        private readonly ContentManagerInterface $contentManager,
        private readonly Environment $twig,
    )
    {
    }

    #[Route('/', name: 'home')]
    public function home(PaginatorInterface $paginator, Request $request): Response
    {
        try {
            $articles = $this->contentManager->getContents(Article::class);
        } catch (ContentNotFoundException $exception) {
            throw $this->createNotFoundException(sprintf(
                'Page not found. Did you forget to create a `content/pages/%s.md/html` file?',
                '{dummy}',
            ), $exception);
        }

        $pagination = $paginator->paginate(
            $articles, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );

        return $this->render('pages/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * This route is used to display pages from `content/pages`.
     * Since this is a catch-all route, it has a very low priority.
     */
    #[Route('/{slug}', name: 'page', requirements: ['slug' => '[^\.]+'], priority: -500)]
    public function page(string $slug): Response
    {
        try {
            $page = $this->contentManager->getContent(Page::class, $slug);
        } catch (ContentNotFoundException $exception) {
            throw $this->createNotFoundException(sprintf(
                'Page not found. Did you forget to create a `content/pages/%s.md/html` file?',
                $slug,
            ), $exception);
        }

        // You can create a custom template for each page, named after its slug,
        // (e.g: For "foo/bar.md" file => use "foo/bar.html.twig")
        // or use the generic "page.html.twig" one.
        if (!$this->twig->getLoader()->exists($template = "$slug.html.twig")) {
            $template = 'page.html.twig';
        }

        return $this->render($template, ['page' => $page]);
    }

}
