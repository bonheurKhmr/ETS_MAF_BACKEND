<?php

namespace App\Service;

use App\Repository\MenuRepository;
use App\Repository\MenuTypeRepository;

final class MenuService 
{

    public function __construct(
        readonly private MenuRepository $menuRepository,
        readonly private MenuTypeRepository $menuTypeRepository,
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

}