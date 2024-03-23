<?php

namespace App\Controller;
use App\Service\PanierService;
use SebastianBergmann\CodeCoverage\Report\Html\Renderer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/{_locale}/panier/', name: 'app_panier_index')]
    public function index(PanierService $panierService): Response
    {

        $contenu = $panierService->getContenu();
        //var_dump($contenu);
        $total = $panierService->getTotal();
        return $this->render('panier/index.html.twig', [
            'contenu' => $contenu, 'total' => $total]);
    }

    #[Route('/{_locale}/panier/ajouter/{idProduit}/{quantite}', name: 'app_panier_ajouter')]
    public function panierAjouter(PanierService $panierService,int $idProduit, int $quantite): Response
    {
        
        $panierService->ajouterProduit($idProduit,$quantite);
        return $this->redirectToRoute('app_panier_index');
    }


    #[Route('/{_locale}/panier/enlever/{idProduit}/{quantite}', name: 'app_panier_enlever')]
    public function panierEnlever(PanierService $panierService,int $idProduit, int $quantite): Response
    {
        $panierService->enleverProduit($idProduit,$quantite);
        return $this->redirectToRoute('app_panier_index');
    }

    #[Route('/{_locale}/panier/supprimer/{idProduit}', name: 'app_panier_supprimer')]
    public function panierSupprimer(PanierService $panierService,int $idProduit): Response
    {
        $panierService->supprimerProduit($idProduit);
        return $this->redirectToRoute('app_panier_index');
    }

    #[Route('/{_locale}/panier/vider', name: 'app_panier_vider')]
    public function panierVider(PanierService $panierService): Response
    {
        $panierService->vider();
        return $this->redirectToRoute('app_panier_index');
    }

    public function nombreProduits(PanierService $panierService): Response 
    { 
        $NombreProduit = $panierService->getNombreProduits();
        return new Response($NombreProduit); 
    }
}
