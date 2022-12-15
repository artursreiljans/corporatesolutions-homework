<?php

declare(strict_types=1);

namespace App\Entity;

use App\Calculator\VatCalculator;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Artūrs Reiljans <ernt@ernt.lv>
 */
#[ORM\Entity]
class Product
{
    #[ORM\Column, ORM\Id, ORM\GeneratedValue]
    public readonly int $id;

    #[ORM\Column]
    public string $name;

    #[ORM\Column]
    public int $quantity;

    #[ORM\Column]
    public int $price;

    #[ORM\OneToMany('product', ProductVersion::class, ['persist'])]
    private Collection $versions;

    public VatCalculator $vatCalculator;

    public function __construct()
    {
        $this->versions = new ArrayCollection();
    }

    public function addVersion(ProductVersion $version): void
    {
        $this->versions->add($version);
    }

    public function getPriceWithVat(): int
    {
        return $this->vatCalculator->getPriceWithVAT($this->price);
    }
}
