<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PdfFileController extends AbstractController
{
    #[Route('/user-information', name: 'app_user_information')]
    public function index(): Response
    {
        return $this->render('pdf_file/index.html.twig', [
            'controller_name' => 'PdfFileController',
        ]);
    }
}
