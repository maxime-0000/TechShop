<?php
// src/Controller/LuckyController.php
namespace App\Controller;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{
    #[Route('/', name: 'default')]
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('accueil.html.twig', [
            'number' => $number,
        ]);
    }
}