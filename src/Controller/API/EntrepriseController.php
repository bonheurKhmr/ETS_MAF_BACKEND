<?php

namespace App\Controller\API;

use App\Entity\Menu;
use App\Repository\EntrepriseRepository;
use App\Repository\MenuRepository;
use App\Repository\MenuTypeRepository;
use App\Repository\SousMenuRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route(path: '/api/entreprise')]
final class EntrepriseController extends AbstractController
{
    public function __construct(
        readonly private EntrepriseRepository $entrepriseRepository
    ) {}

    #[Route(name: 'app_api_entreprise', methods: ["GET"])]
    public function index(Request $request): Response
    {
        $data = $this->entrepriseRepository->findOneBy(["activated" => true], ["id" => "DESC"]);
        return $this->json(["data" => $data], 200, [], [
            "groups" => ["entreprise.index"]
        ]);
    }
}
