<?php

namespace App\Controller\Frontend;

use App\Repository\MenuRepository;
use App\Repository\ServiceRepository;
use App\Repository\SousMenuRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceController extends AbstractController
{
    #[Route('service', name: 'frontend_service')]
    public function index(
        SousMenuRepository $sousMenuRepository,
        MenuRepository $menuRepository,
        ServiceRepository $serviceRepository
    ): Response
    {
        $menu_id = $menuRepository->findOneBy(['name' => 'frontend_service']);
        $sousMenus = $sousMenuRepository->findBy([
            'menu' => $menu_id->getId(), 
            'is_activated' => true]
        );

        return $this->render('frontend/service/index.html.twig', [
            'sousMenus' => $sousMenus,
            'services' => $serviceRepository->findAll()
        ]);
    }
}
