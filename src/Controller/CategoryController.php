<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Article\Article;
use App\Model\Category;
use Knp\Component\Pager\PaginatorInterface;
use Stenope\Bundle\ContentManagerInterface;
use Stenope\Bundle\Service\ContentUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categories')]
class CategoryController extends AbstractController
{
    public function __construct(private readonly ContentManagerInterface $manager)
    {
    }

    #[Route('/{category}', name: 'app_category', requirements: ['category' => '.+'])]
    public function show(Category $category, PaginatorInterface $paginator, Request $request): Response
    {
        $articles = $this->manager->getContents(Article::class, ['publishedAt' => false], ['category' => $category]);

        $pagination = $paginator->paginate(
            $articles, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );

        return $this->render('pages/articles/list.html.twig',[
            'pagination' => $pagination
        ]);
    }
}
