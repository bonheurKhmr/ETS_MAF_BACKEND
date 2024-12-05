<?php

namespace App\Controller\Admin;

use App\Entity\SousMenu;
use App\Form\SousMenuType;
use App\Repository\MenuTypeRepository;
use App\Repository\SousMenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/sous-menu')]
final class SousMenuController extends AbstractController
{

    #[Route(name: 'app_admin_sous_menu_index', methods: ['GET'])]
    public function index(SousMenuRepository $sousMenuRepository): Response
    {
        return $this->render('admin/sous_menu/index.html.twig', [
            'sous_menus' => $sousMenuRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_sous_menu_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sousMenu = new SousMenu();
        $form = $this->createForm(SousMenuType::class, $sousMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sousMenu);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_sous_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/sous_menu/new.html.twig', [
            'sous_menu' => $sousMenu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_sous_menu_show', methods: ['GET'])]
    public function show(SousMenu $sousMenu): Response
    {
        return $this->render('admin/sous_menu/show.html.twig', [
            'sous_menu' => $sousMenu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_sous_menu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SousMenu $sousMenu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SousMenuType::class, $sousMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_sous_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/sous_menu/edit.html.twig', [
            'sous_menu' => $sousMenu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_sous_menu_delete', methods: ['POST'])]
    public function delete(Request $request, SousMenu $sousMenu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousMenu->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($sousMenu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_sous_menu_index', [], Response::HTTP_SEE_OTHER);
    }
}
