<?php
// src/Controller/LuckyController.php
namespace App\Controller;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function number(): Response
    {
        return $this->render('accueil.html.twig');
    }
}
