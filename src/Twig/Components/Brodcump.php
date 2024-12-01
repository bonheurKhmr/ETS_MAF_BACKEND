<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Brodcump
{
    public string $dashboardLink = 'app_admin_dashboard';
    public string $firstLink = '';
    public string $firstLabel = '';
    public string $pageActuel = '';
}
