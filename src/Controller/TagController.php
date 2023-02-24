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

#[Route('/tags')]
class TagController extends AbstractController
{
    public function __construct(private readonly ContentManagerInterface $manager)
    {
    }

    #[Route('/', name: 'app_tag_list', priority: -200)]
    public function list(PaginatorInterface $paginator, Request $request): Response
    {
        $tags = $this->manager->getContents(Article::class, ['publishedAt' => false]);

        $pagination = $paginator->paginate(
            $tags, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );

        return $this->render('pages/articles/list.html.twig', [
            'pagination' => $pagination
        ])->setLastModified(ContentUtils::max($tags, 'lastModifiedOrCreated'));
    }

    #[Route('/{tag}', name: 'app_tag_show', requirements: ['tag' => '.+'])]
    public function show(Article $article): Response
    {
        return $this->render('pages/articles/show.html.twig', [
            'article' => $article,
        ])->setLastModified($article->getLastModifiedOrCreated());
    }
}
