<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier')]
    public function index(Request $request, ProduitRepository $produitRepository): Response
    {
        $panier = $request->getSession()->get('panier', []);
        $produits = [];
        $total = 0;

        foreach ($panier as $id) {
            $produit = $produitRepository->find($id);

            if ($produit) {
                $produits[] = $produit;
                $total += (int) str_replace('.', '', $produit->getPrix());
            }
        }

        return $this->render('panier.html.twig', [
            'produits' => $produits,
            'total' => $total / 100
        ]);
    }

    #[Route('/panier/ajouter/{id}', name: 'panier_ajouter', methods: ['POST'])]
    public function ajouter(int $id, Request $request, ProduitRepository $produitRepository): Response
    {
        if (!$this->isCsrfTokenValid('panier', $request->request->get('_token'))) {
            throw $this->createAccessDeniedException();
        }

        $produit = $produitRepository->find($id);

        if (!$produit) {
            throw $this->createNotFoundException();
        }

        $panier = $request->getSession()->get('panier', []);
        $panier[] = $id;

        $request->getSession()->set('panier', $panier);

        return $this->redirectToRoute('catalogue', [], 303);
    }
}
            
