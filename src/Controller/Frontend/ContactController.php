<?php

namespace App\Controller\Frontend;

use App\Repository\ContactRepository;
use App\Repository\MenuRepository;
use App\Repository\SousMenuRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'frontend_contact')]
    public function index(
        SousMenuRepository $sousMenuRepository,
        MenuRepository $menuRepository,
        ContactRepository $contactRepository
    ): Response
    {
        $menu_id = $menuRepository->findOneBy(['name' => 'frontend_contact']);
        $sousMenus = $sousMenuRepository->findBy([
            'menu' => $menu_id->getId(), 
            'is_activated' => true]
        );
        return $this->render('frontend/contact/index.html.twig', [
            "sousMenus" => $sousMenus,
            "contacts" => $contactRepository->findAll()
        ]);
    }
}
