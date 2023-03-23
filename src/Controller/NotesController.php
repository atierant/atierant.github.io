<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/notes')]
class NotesController extends AbstractController
{
    #[Route('/', name: 'app_notes_index')]
    public function index(): Response
    {
        return $this->render('pages/notes.html.twig');
    }
}
