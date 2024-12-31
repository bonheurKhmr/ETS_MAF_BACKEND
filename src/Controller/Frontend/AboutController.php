<?php

namespace App\Controller\Frontend;

use App\Repository\MenuRepository;
use App\Repository\SousMenuRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'frontend_about')]
    public function index(
        SousMenuRepository $sousMenuRepository,
        MenuRepository $menuRepository
    ): Response
    {
        $menu_id = $menuRepository->findOneBy(['name' => 'frontend_about']);
        $sousMenus = $sousMenuRepository->findBy([
            'menu' => $menu_id->getId(), 
            'is_activated' => true]
        );

        return $this->render('frontend/about/index.html.twig', [
            'sousMenus' => $sousMenus
        ]);
    }
}
