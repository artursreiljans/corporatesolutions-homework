<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\ProductVersion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Artūrs Reiljans <ernt@ernt.lv>
 */
final class AuditController extends AbstractController
{
    #[Route(path: '/audit', name: 'audit')]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        $limit = 10;

        $data = $entityManager
            ->getRepository(ProductVersion::class)
            ->findBy([], ['id' => 'DESC'], $limit);

        $data = \array_map(
            fn(ProductVersion $version): array => $version->getView(),
            $data,
        );
        return new JsonResponse($data);
    }
}
