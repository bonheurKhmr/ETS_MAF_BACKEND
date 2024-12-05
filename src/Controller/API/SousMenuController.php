<?php

namespace App\Controller\API;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use App\Repository\MenuTypeRepository;
use App\Repository\SousMenuRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route(path: '/api/sous-menu')]
final class SousMenuController extends AbstractController
{
    public function __construct(
        readonly private MenuRepository $menuRepository,
        readonly private MenuTypeRepository $menuTypeRepository,
        readonly private SousMenuRepository $sousMenuRepository,
    ) {}

    #[Route('/{menu}', name: 'app_api_sous_menu', methods: ["GET"])]
    public function index(Request $request): Response
    {
        $menuId = $request->attributes->get('menu');
        $data = $this->sousMenuRepository->findBy([
            'menu' => $this->menuRepository->findOneBy(["id" => $menuId]),
            'is_activated' => true
        ],["orders" => "ASC"]);

        return $this->json(["data" => $data], 200, [], [
            "groups" => ["sous_menu.index"]
        ]);
    }
}
