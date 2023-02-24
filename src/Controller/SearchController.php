<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/search')]
class SearchController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route('/', name: 'search')]
    public function list(): Response
    {
        return $this->render('pages/search.html.twig');
    }
}
