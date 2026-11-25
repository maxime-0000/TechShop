<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CatalogueController extends AbstractController
{
    public function __construct(private readonly ProduitRepository $produitRepository)
    {
    }

    #[Route('/catalogue', name: 'catalogue')]
    public function index(): Response
    {
        $produits = $this->produitRepository->findBy([], ['nom' => 'ASC']);

        return $this->render('catalogue.html.twig', [
            'produits' => $produits,
        ]);
    }
}
