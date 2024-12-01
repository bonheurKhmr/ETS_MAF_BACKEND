<?php

namespace App\Twig\Components\Action;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Show
{
    public string $href = "";
}
