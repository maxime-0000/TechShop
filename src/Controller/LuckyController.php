<?php
// src/Controller/LuckyController.php
namespace App\Controller;
use App\Repository\ProduitRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{
    public function __construct(private readonly ProduitRepository $produitRepository)
    {
    }

    #[Route('/', name: 'accueil')]
    public function number(): Response
    {
        return $this->render('accueil.html.twig', [
            'produits' => $this->produitRepository->findBy([], ['nom' => 'ASC']),
        ]);
    }
}
