<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Page;
use Stenope\Bundle\ContentManagerInterface;
use Stenope\Bundle\Exception\ContentNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class FeedController extends AbstractController
{
    public function __construct(
        private readonly ContentManagerInterface $contentManager,
        private readonly Environment $twig,
    ) {
    }

//    #[Route('/feed.xml', name: 'feed.xml')]
//    public function feed(): Response
//    {
//        return $this->render('feed');
//    }
}
