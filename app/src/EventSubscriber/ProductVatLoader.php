<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Calculator\VatCalculator;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Artūrs Reiljans <ernt@ernt.lv>
 */
final class ProductVatLoader implements EventSubscriberInterface
{
    public function __construct(
        private readonly VatCalculator $vatCalculator,
    ) {}

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

        $entity->vatCalculator = $this->vatCalculator;
    }
}
