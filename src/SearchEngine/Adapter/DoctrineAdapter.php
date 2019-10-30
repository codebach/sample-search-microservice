<?php
declare(strict_types = 1);

namespace App\SearchEngine\Adapter;

use Doctrine\ORM\EntityManagerInterface;

class DoctrineAdapter implements DatabaseAdapterInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute(string $query, ?array $params): array
    {
        $statement = $this->entityManager->getConnection()->prepare($query);

        $statement->execute($params);

        return $statement->fetchAll();
    }
}
