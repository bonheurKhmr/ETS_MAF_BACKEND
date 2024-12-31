<?php

namespace App\Service;

use App\Entity\Entreprise;
use App\Repository\EntrepriseRepository;
use App\Repository\MenuRepository;
use App\Repository\MenuTypeRepository;

final class MenuService 
{

    public function __construct(
        readonly private MenuRepository $menuRepository,
        readonly private MenuTypeRepository $menuTypeRepository,
        readonly private EntrepriseRepository $entrepriseRepository
    )
    {
    }

    public function getBackendSidebarMenu ()
    {
        return $this
            ->menuRepository->findBy([
                "type" => $this->menuTypeRepository->findOneBy(['type' => 'backend sidebar']),
                "is_activated" => true
            ],
            ["orders" => "ASC"]);
    }

    public function getFrontendMenu () {
        return $this
            ->menuRepository->findBy([
                "type" => $this->menuTypeRepository->findOneBy(['type' => 'frontend navbar']),
                "is_activated" => true
            ],
            ["orders" => "ASC"]);
    }

    public function getHeaderData () {
        return $this->entrepriseRepository->getActivatedEntreprise();
    }

}