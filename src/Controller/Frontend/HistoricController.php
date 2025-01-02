<?php

namespace App\Controller\Frontend;

use App\Repository\MenuRepository;
use App\Repository\SousMenuRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HistoricController extends AbstractController
{
    #[Route('historic', name: 'frontend_historic')]
    public function index(
        SousMenuRepository $sousMenuRepository,
        MenuRepository $menuRepository,
    ): Response
    {
        $menu_id = $menuRepository->findOneBy(['name' => 'frontend_historic']);
        $sousMenus = $sousMenuRepository->findBy([
            'menu' => $menu_id->getId(), 
            'is_activated' => true]
        );
        return $this->render('frontend/historic/index.html.twig', [
            'sousMenus' => $sousMenus,
        ]);
    }
}
