<?php

namespace App\Controller\Frontend;

use App\Entity\Contact;
use App\Entity\Message;
use App\Entity\Notification;
use App\Repository\MenuRepository;
use App\Repository\ContactRepository;
use App\Repository\SousMenuRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/contact-nous', name: 'app_contact', methods: ["POST"])]
    public function contact (Request $request, UserRepository $userRepository, EntityManagerInterface $em): Response
    {
        $data = $request->request->all();
        $user = $userRepository->findUsersByRole("ROLE_ADMIN");
        $contact = (new Message())
            ->setFullname($data["first_name"])
            ->setEmail($data["email"])
            ->setContent($data["message"])
            ->setCreatedAt(new \DateTimeImmutable())
            ->setStatus(false)
            ->setUser($user);

        $notification = (new Notification())
            ->setNotification('vous avez un nouvaux message par contact')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setIpAddSend($request->getClientIp())
            ->setStatus(false)
            ->setUser($user);

        $em->persist($contact);
        $em->persist($notification);
        $em->flush();

        return $this->json([
            "success" => "nous avons reusi votre message nous vous contacteront sur votre email sous peu"
        ]);
    }
}