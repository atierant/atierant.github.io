<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Article\Article;
use App\Model\Category;
use Knp\Component\Pager\PaginatorInterface;
use Stenope\Bundle\ContentManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categories')]
class CategoryController extends AbstractController
{
    public const LIMIT_PER_PAGE = 5;

    #[Route('/{category}/{page}', name: 'app_category', requirements: [
        'category' => '.+',
        'page' => '\d+',
    ], defaults: [
        'page' => '1',
    ], priority: -200)]
    public function show(int $page, Category $category, PaginatorInterface $paginator, ContentManagerInterface $manager): Response
    {
        $articles = $manager->getContents(Article::class, [
            'publishedAt' => false,
        ], [
            'category' => $category->slug,
        ]);

        $pagination = $paginator->paginate(
            $articles, /* query NOT result */
            $page, /* page number */
            self::LIMIT_PER_PAGE /* limit per page */
        );

        return $this->render('pages/articles/list.html.twig', [
            'pagination' => $pagination,
            'category' => $category,
        ]);
    }
}
