<?php
namespace App\Controller\Frontend;

use App\Entity\Service;
use App\Repository\EntrepriseRepository;
use App\Repository\MenuRepository;
use App\Repository\ServiceRepository;
use App\Repository\SousMenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController 
{
    #[Route('/', 'app_home')]
    public function index (
        SousMenuRepository $sousMenuRepository,
        MenuRepository $menuRepository,
        ServiceRepository $serviceRepository
    ): Response
    {
        $menu_id = $menuRepository->findOneBy(['name' => 'app_home']);
        $sousMenus = $sousMenuRepository->findBy([
            'menu' => $menu_id->getId(), 
            'is_activated' => true]
        );
        return $this->render('frontend/home/index.html.twig', [
            'sousMenus' => $sousMenus,
            'services' => $serviceRepository->findAll()
        ]);
    }
}