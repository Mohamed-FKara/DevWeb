<?php

namespace App\Controller;

use App\Service\ChangeMonnaieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route(
        path: '/{_locale}',
        name: 'app_default_index',
        defaults: ['_locale' => 'fr']
    )]
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    // TODO : route
    #[Route(
        path: '/{_locale}/contact',
        name: 'app_default_contact'
    )]
    public function contact(): Response
    {
        return $this->render('default/contact.html.twig');
    }

    #[Route(
        path: '/{_locale}/boutique',
        name: 'app_default_boutique'
    )]

    public function boutique(): Response
    {
        return $this->render('boutique/index.html.twig');
    }
}
