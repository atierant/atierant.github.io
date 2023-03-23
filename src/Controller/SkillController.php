<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Resume\Skill;
use Stenope\Bundle\ContentManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/skills')]
class SkillController extends AbstractController
{
    #[Route('/', name: 'app_skills_list')]
    public function list(
        ContentManagerInterface $manager,
    ): Response {
        $skills = $manager->getContents(Skill::class);

        return $this->render('pages/skills/list.html.twig', [
            'skills' => $skills,
        ]);
    }

    #[Route('/{skill}', name: 'app_skills_show', requirements: [
        'skill' => '.+',
    ], priority: -497)]
    public function show(Skill $skill): Response
    {
        return $this->render('pages/skills/show.html.twig', [
            'skill' => $skill,
        ]);
    }
}
