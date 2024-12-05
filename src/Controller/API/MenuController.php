<?php

namespace App\Controller\API;

use App\Repository\MenuRepository;
use App\Repository\MenuTypeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route(path: '/api/menu')]
final class MenuController extends AbstractController
{
    public function __construct(
        readonly private MenuRepository $menuRepository,
        readonly private MenuTypeRepository $menuTypeRepository,
    ) {}

    #[Route(name: 'app_api_menu', methods: ["GET"])]
    public function index(): Response
    {
        $data = $this
            ->menuRepository->findBy([
                "type" => $this->menuTypeRepository->findOneBy(['type' => 'frontend navbar']),
                "is_activated" => true
            ],["orders" => "ASC"]);

        return $this->json(["data" => $data], 200, [], [
            "groups" => ["menu.index"]
        ]);
    }
}
