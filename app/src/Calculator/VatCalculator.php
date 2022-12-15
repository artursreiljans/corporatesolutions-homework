<?php

declare(strict_types=1);

namespace App\Calculator;

use Symfony\Component\DependencyInjection\Attribute\Autowire;

/**
 * @author Artūrs Reiljans <ernt@ernt.lv>
 */
final class VatCalculator
{
    private readonly float $vat;

    public function __construct(
        #[Autowire(value: '%vat%')]
        float $vat,
    ) {
        $this->vat = $vat;
    }

    public function getPriceWithVAT(int $price): int
    {
        return (int) ($price * (100 + $this->vat) / 100);
    }
}
