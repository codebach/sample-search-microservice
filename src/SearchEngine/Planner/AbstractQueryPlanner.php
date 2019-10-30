<?php
declare(strict_types = 1);

namespace App\SearchEngine\Planner;

use App\SearchEngine\Adapter\DatabaseAdapterInterface;

abstract class AbstractQueryPlanner
{
    protected $databaseAdapter;

    public function __construct(DatabaseAdapterInterface $databaseAdapter)
    {
        $this->databaseAdapter = $databaseAdapter;
    }

    abstract public function search(string $text, ?int $limit, ?int $offset, ?string $sortBy, ?array $filters): array;

    abstract public function count(string $text, ?array $filters): int;
}
