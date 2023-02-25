<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Article\Article;
use App\Model\Tag;
use Knp\Component\Pager\PaginatorInterface;
use Stenope\Bundle\ContentManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tags')]
class TagController extends AbstractController
{
    public const LIMIT_PER_PAGE = 5;

    #[Route('/{page}', name: 'app_tag_list', requirements: [
        'page' => '\d+',
    ], defaults: [
        'page' => '1',
    ], priority: -200)]
    public function list(int $page, PaginatorInterface $paginator, ContentManagerInterface $manager): Response
    {
        $tags = $manager->getContents(Tag::class);

        $pagination = $paginator->paginate(
            $tags, /* query NOT result */
            $page, /* page number */
            self::LIMIT_PER_PAGE /* limit per page */
        );

        return $this->render('pages/tags/list.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/{tag}/{page}', name: 'app_tag_show', requirements: [
        'tag' => '.+',
        'page' => '\d+',
    ], defaults: [
        'page' => '1',
    ])]
    public function show(int $page, Tag $tag, PaginatorInterface $paginator, ContentManagerInterface $manager): Response
    {
        $articles = $manager->getContents(Article::class, [
            'publishedAt' => false,
        ], [
            'tag' => $tag->slug,
        ]);

        $pagination = $paginator->paginate(
            $articles, /* query NOT result */
            $page, /* page number */
            self::LIMIT_PER_PAGE /* limit per page */
        );

        return $this->render('pages/articles/list.html.twig', [
            'pagination' => $pagination,
            'tag' => $tag,
        ]);
    }
}
