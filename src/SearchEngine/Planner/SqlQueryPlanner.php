<?php
declare(strict_types = 1);

namespace App\SearchEngine\Planner;

class SqlQueryPlanner extends AbstractQueryPlanner
{
    public function search(string $text, ?int $limit, ?int $offset, ?string $sortBy, ?array $filters): array
    {
        $query = 'SELECT * FROM product WHERE title LIKE :title';

        $params['title'] = '%'.$text.'%';

        if (isset($filters)) {
            foreach ($filters as $filterName => $filterValue) {
                $query .= sprintf(' AND %s = :%s', $filterName, $filterName);

                $params[$filterName] = $filterValue;
            }
        }

        if (isset($sortBy)) {
            $query .= sprintf(' ORDER BY %s ASC', $sortBy);
        }

        if (isset($limit) && isset($offset)) {
            $query .= sprintf(' LIMIT %d, %d', $offset, $limit);
        }

        return $this->databaseAdapter->execute($query, $params);
    }

    public function count(string $text, ?array $filters): int
    {
        $query = "SELECT COUNT(*) FROM product WHERE title LIKE :title";

        $params['title'] = '%'.$text.'%';

        if (isset($filters)) {
            foreach ($filters as $filterName => $filterValue) {
                $query .= sprintf(' AND %s = :%s', $filterName, $filterName);

                $params[$filterName] = $filterValue;
            }
        }

        $result = $this->databaseAdapter->execute($query, $params);

        return (int) $result[0]['COUNT(*)'];
    }
}
