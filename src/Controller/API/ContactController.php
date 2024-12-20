<?php

namespace App\Controller\API;

use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route(path: '/api/contact')]
final class ContactController extends AbstractController
{
    public function __construct(
        readonly private ContactRepository $contactRepository
    ) {}

    #[Route(name: 'app_api_contact', methods: ["GET"])]
    public function index(Request $request): Response
    {
        $data = $this->contactRepository->findAll() ;
        return $this->json(["data" => $data], 200, [], [
            "groups" => ["contact.index"]
        ]);
    }
}
