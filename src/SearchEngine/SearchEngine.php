<?php
declare(strict_types = 1);

namespace App\SearchEngine;

use App\SearchEngine\Planner\AbstractQueryPlanner;

class SearchEngine
{
    const LIMIT = 3;

    private $offset = 0;

    private $sortBy;

    private $filters;

    private $queryPlanner;

    public function __construct(AbstractQueryPlanner $queryPlanner)
    {
        $this->queryPlanner = $queryPlanner;
    }

    public function sortBy(string $sortBy): self
    {
        /* @todo: check allowed fields */
        $this->sortBy = $sortBy;

        return $this;
    }

    public function applyFilters(array $filters): self
    {
        /* @todo: check allowed fields */
        $this->filters = $filters;

        return $this;
    }

    public function setPagination(int $page): self
    {
        if (1 < $page) {
            $this->offset = self::LIMIT * ($page - 1);
        }

        return $this;
    }

    public function search(string $text): array
    {
        return $this->queryPlanner->search($text, self::LIMIT, $this->offset, $this->sortBy, $this->filters);
    }

    public function getPageCount(string $text): float
    {
        $count = $this->queryPlanner->count($text, $this->filters);

        return ceil($count/self::LIMIT);
    }
}
