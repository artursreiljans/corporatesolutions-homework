<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

/**
 * @author Artūrs Reiljans <ernt@ernt.lv>
 */
final class ProductVatLoader implements EventSubscriberInterface
{
    private readonly float $vat;

    public function __construct(
        #[Autowire(value: '%vat%')]
        float $vat,
    ) {
        $this->vat = $vat;
    }

    public function getSubscribedEvents(): array
    {
        return [Events::postLoad => '__invoke'];
    }

    public function __invoke(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof Product) {
            return;
        }

        var_dump('here');
        exit;

        $entity->priceWithVat = $entity->price * (100 + $this->vat);
    }
}
