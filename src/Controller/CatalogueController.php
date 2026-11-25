<?php
// src/Controller/LuckyController.php
namespace App\Controller;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CatalogueController extends AbstractController
{
    public function __construct(private readonly ProduitRepository $produitRepository)
    {
    }

    #[Route('/catalogue', name: 'catalogue')]
    public function index(): Response
    {
        return $this->render('catalogue.html.twig');
    }

    #[Route('/api/produits', name: 'api_produits', methods: ['GET'])]
    public function api(Request $request): JsonResponse
    {
        $page = max(1, $request->query->getInt('page', 1));
        $perPage = min(50, max(1, $request->query->getInt('per_page', 10)));
        $offset = ($page - 1) * $perPage;

        $produits = $this->produitRepository->findBy([], ['nom' => 'ASC'], $perPage, $offset);
        $resultats = array_map(static fn (Produit $produit): array => [
            'id' => $produit->getId(),
            'nom' => $produit->getNom(),
            'quantite' => $produit->getQuantite(),
            'description' => $produit->getDescription(),
            'imageUrl' => $produit->getImageUrl(),
        ], $produits);

        return $this->json($resultats);
    }
}
