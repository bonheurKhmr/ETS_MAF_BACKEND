<?php

namespace App\Controller\Admin;

use App\Entity\RoleUser;
use App\Form\RoleUserType;
use App\Repository\RoleUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/role/user')]
final class RoleUserController extends AbstractController
{
    #[Route(name: 'app_admin_role_user_index', methods: ['GET'])]
    public function index(RoleUserRepository $roleUserRepository): Response
    {
        return $this->render('admin/role_user/index.html.twig', [
            'role_users' => $roleUserRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_role_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $roleUser = new RoleUser();
        $form = $this->createForm(RoleUserType::class, $roleUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($roleUser);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_role_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/role_user/new.html.twig', [
            'role_user' => $roleUser,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_role_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RoleUser $roleUser, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RoleUserType::class, $roleUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_role_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/role_user/edit.html.twig', [
            'role_user' => $roleUser,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_role_user_delete', methods: ['POST'])]
    public function delete(Request $request, RoleUser $roleUser, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$roleUser->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($roleUser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_role_user_index', [], Response::HTTP_SEE_OTHER);
    }
}