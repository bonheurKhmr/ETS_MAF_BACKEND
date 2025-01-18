<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Brodcump
{
    public string $dashboardlink = 'app_admin_dashboard';
    public string $firstlink = '';
    public string $firstlabel = '';
    public string $pageactuel = '';
}
