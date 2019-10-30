<?php
declare(strict_types = 1);

namespace App\SearchEngine\Adapter;

interface DatabaseAdapterInterface
{
    public function execute(string $query, ?array $params): array;
}