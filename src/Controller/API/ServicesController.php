<?php

namespace App\Controller\API;

use App\Repository\MenuRepository;
use App\Repository\MenuTypeRepository;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route(path: '/api/services')]
final class ServicesController extends AbstractController
{
    public function __construct(
        readonly private ServiceRepository $serviceRepository
    ) {}

    #[Route(name: 'app_api_service', methods: ["GET"])]
    public function index(): Response
    {
        $data = $this
            ->serviceRepository->findBy([
                "is_activated" => true
            ],["id" => "DESC"]);

        return $this->json(["data" => $data], 200, [], [
            "groups" => ["service.index"]
        ]);
    }
}
