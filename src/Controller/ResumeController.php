<?php

namespace App\Controller;

use App\Model\Resume\Work;
use Stenope\Bundle\ContentManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route('/resume')]
class ResumeController extends AbstractController
{
    public function __construct(
        private readonly ContentManagerInterface $contentManager,
        private readonly Environment $twig,
    )
    {
    }

    #[Route('/', name: 'resume')]
    public function resume(): Response
    {
        return $this->render('pages/resume/list.html.twig');
    }

//    /**
//     * This route is used to display pages from `content/pages`.
//     * Since this is a catch-all route, it has a very low priority.
//     */
//    #[Route('/{section}/{slug}', name: 'app_resume_show_by_section', requirements: ['section' => '[^\.\/]+', 'slug' => '[^\.]+'], priority: -498)]
//    public function showBySectrion(string $section, string $slug): Response
//    {
//        switch ($section) {
//            case 'work': {
//                $template = $this->contentManager->getContent(Work::class, $slug);
//                $item = $this->contentManager->getContent(Work::class, $slug);
//            }
//        }
//        return $this->render('pages/resume/show.html.twig', [
//            'section' => $section,
//            'item' => $item,
//        ]);
//    }

    /**
     * This route is used to display pages from `content/pages`.
     * Since this is a catch-all route, it has a very low priority.
     */
    #[Route('/work/{work}', name: 'app_work_show', requirements: ['work' => '[^\.]+'], priority: -499)]
    public function showWork(Work $work): Response
    {
        return $this->render('pages/resume/show.html.twig', ['item' => $work]);
    }

//    /**
//     * This route is used to display pages from `content/pages`.
//     * Since this is a catch-all route, it has a very low priority.
//     */
//    #[Route('/{slug}', name: 'app_resume_show', requirements: ['slug' => '[^\.]+'], priority: -499)]
//    public function show(string $slug): Response
//    {
//        return $this->render('pages/resume/show.html.twig', [
//            'item' => $slug,
//        ]);
//    }
}
