<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class ActionButton
{
    public string $edit = "";
    public string $show = "";
    public string $delete = "";
}
