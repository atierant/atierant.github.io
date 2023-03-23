<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Resume\Education;
use App\Model\Resume\Experience;
use App\Model\Resume\Internship;
use App\Model\Resume\Organization;
use App\Model\Resume\Work;
use Stenope\Bundle\ContentManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/resume')]
class ResumeController extends AbstractController
{
    #[Route('/', name: 'resume')]
    public function resume(ContentManagerInterface $manager, Request $request): Response
    {
        $locale = $request->getLocale();
        $workItems = $manager->getContents(
            Work::class,
            [
                'startDate' => false,
            ],
            function (Work $work) use ($locale): bool {
                return $work->lang === $locale;
            }
        );
        $educationItems = $manager->getContents(
            Education::class,
            [
                'startDate' => false,
            ],
            function (Education $education) use ($locale): bool {
                return $education->lang === $locale;
            }
        );
        $internshipItems = $manager->getContents(
            Internship::class,
            [
                'startDate' => false,
            ],
            function (Internship $internship) use ($locale): bool {
                return $internship->lang === $locale;
            }
        );
        return $this->render('pages/resume/list.html.twig', [
            'workItems' => $workItems,
            'educationItems' => $educationItems,
            'internshipItems' => $internshipItems,
        ]);
    }

    #[Route(
        '/work/{work}/experience/{experience}',
        name: 'app_experience_show',
        requirements: [
            'work' => '[^/]+',
            'experience' => '[^\.]+',
        ],
        priority: -498
    )]
    public function showExperience(Work $work, Experience $experience): Response
    {
        return $this->render('pages/resume/show_experience.html.twig', [
            'work' => $work,
            'experience' => $experience,
        ]);
    }

    #[Route(
        '/organization/{organization}',
        name: 'app_organization_show',
        requirements: [
            'organization' => '[^\.]+',
        ],
        priority: -499
    )
    ]
    public function organization(Organization $organization): Response
    {
        return $this->render('pages/resume/show_organization.html.twig', [
            'organization' => $organization,
        ]);
    }

    #[Route('/work/{work}', name: 'app_work_show', requirements: [
        'work' => '[^\.]+',
    ], priority: -499)
    ]
    public function work(Work $work): Response
    {
        return $this->render('pages/resume/show.html.twig', [
            'work' => $work,
        ]);
    }
}
