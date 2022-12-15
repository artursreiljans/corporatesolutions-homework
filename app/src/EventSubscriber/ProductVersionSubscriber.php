<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Entity\Product;
use App\Entity\ProductVersion;
use EasyCorp\Bundle\EasyAdminBundle\Event\AbstractLifecycleEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Psr\Clock\ClockInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author Artūrs Reiljans <ernt@ernt.lv>
 */
final class ProductVersionSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly Security $security,
        private readonly ClockInterface $clock,
    ) {}

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => '__invoke',
            BeforeEntityUpdatedEvent::class => '__invoke',
        ];
    }

    public function __invoke(AbstractLifecycleEvent $event): void
    {
        $entity = $event->getEntityInstance();

        if (!$entity instanceof Product) {
            return;
        }

        $version = new ProductVersion(
            $entity,
            $entity->name,
            $entity->quantity,
            $entity->price,
            $this->security->getUser()->getUserIdentifier(),
            $this->clock->now(),
        );
        $entity->addVersion($version);
    }
}
