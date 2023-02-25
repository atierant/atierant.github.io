<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Resume\Tool;
use Knp\Component\Pager\PaginatorInterface;
use Stenope\Bundle\ContentManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tools')]
class ToolController extends AbstractController
{
    #[Route('/', name: 'app_tools_list', priority: -200)]
    public function list(
        ContentManagerInterface $manager,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $tools = $manager->getContents(Tool::class);

        $pagination = $paginator->paginate(
            $tools, /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
            20 /* limit per page */
        );

        return $this->render('pages/tools/list.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/tools/{tool}', name: 'app_tools_show', requirements: [
        'tool' => '[^\.]+',
    ], priority: -499)
    ]
    public function tools(Tool $tool): Response
    {
        return $this->render('pages/tools/show.html.twig', [
            'tool' => $tool,
        ]);
    }
}
