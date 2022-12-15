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

    public function __construct(
        #[ORM\ManyToOne]
        private Product $product,

        #[ORM\Column]
        private string $name,

        #[ORM\Column]
        private int $quantity,

        #[ORM\Column]
        private int $price,

        #[ORM\Column]
        private string $author,

        #[ORM\Column(type: 'datetime_immutable')]
        private \DateTimeInterface $createdAt,
    ) {}

    public function getView(): array
    {
        return [
            'name' => $this->name,
            'quantity' => $this->quantity,
            'price' => $this->price / 100,
            'author' => $this->author,
            'created_at' => $this->createdAt->format(\DATE_ATOM),
        ];
    }
}
