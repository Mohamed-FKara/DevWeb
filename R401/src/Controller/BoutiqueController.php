<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\BoutiqueService;

class BoutiqueController extends AbstractController
{
    #[Route('/{_locale}/boutique', name: 'app_boutique')]
    public function index(BoutiqueService $boutique): Response
    {
        $categories = $boutique->findAllCategories();

        return $this->render('boutique/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/{_locale}/rayon/{idCategorie}', name:'app_boutique_rayon')]
    public function rayon(BoutiqueService $boutique, int $idCategorie): Response
    {
        $produit = $boutique->findProduitsByCategorie($idCategorie);

        $libelle = $boutique->searchlibelleById($idCategorie);
        return $this->render('boutique/rayon.html.twig', 
        ['produits' => $produit,
        'libelle'=> $libelle]
        );
    }

    #[Route( 
        path: '/{_locale}/chercher/{recherche}', 
        name: 'app_boutique_chercher', 
        requirements: ['recherche' => '.+'], // regexp pour avoir tous les car, / compris 
        defaults: ['recherche' => ''])] 
        public function chercher(BoutiqueService $boutique, string $recherche) : Response 
    {
        $rechercherDecode = urldecode($recherche);
        $rechercheRes = $boutique->findProduitsByLibelleOrTexte($rechercherDecode);
        $nb = count($rechercheRes);
        return $this->render('boutique/chercher.html.twig', 
        ['recherche' => $rechercheRes,
        'count' => $nb]);
    }

}

