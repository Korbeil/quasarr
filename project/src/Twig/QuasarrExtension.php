<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class QuasarrExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('padLeft', [$this, 'padLeft']),
        ];
    }

    public function padLeft(int $value): string
    {
        return str_pad($value, 2, '0', STR_PAD_LEFT);
    }
}
