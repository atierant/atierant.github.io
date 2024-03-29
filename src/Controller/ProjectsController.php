<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Project\Project;
use Stenope\Bundle\ContentManagerInterface;
use Stenope\Bundle\Service\ContentUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/projects')]
class ProjectsController extends AbstractController
{
    #[Route('/', name: 'projects')]
    public function list(ContentManagerInterface $manager): Response
    {
        $projects = $manager->getContents(Project::class, [
            'publishedAt' => true,
        ]);

        return $this->render('pages/projects/list.html.twig', [
            'projects' => $projects,
        ])->setLastModified(ContentUtils::max($projects, 'lastModified'));
    }
}
