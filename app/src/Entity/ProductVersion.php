<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Artūrs Reiljans <ernt@ernt.lv>
 */
#[ORM\Entity]
class ProductVersion
{
    #[ORM\Column, ORM\Id, ORM\GeneratedValue]
    public readonly int $id;

    #[ORM\ManyToOne]
    private Product $product;

    #[ORM\Column]
    private string $name;

    #[ORM\Column]
    private int $quantity;

    #[ORM\Column]
    private int $price;

    #[ORM\Column]
    private string $user;

    #[ORM\Column]
    private \DateTimeInterface $createdAt;
}