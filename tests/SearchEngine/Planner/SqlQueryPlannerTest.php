<?php
declare(strict_types = 1);

namespace App\Tests\SearchEngine\Planner;

use App\SearchEngine\Adapter\DatabaseAdapterInterface;
use App\SearchEngine\Planner\SqlQueryPlanner;
use PHPUnit\Framework\TestCase;

final class SqlQueryPlannerTest extends TestCase
{
    /**
     * @dataProvider queryParams
     */
    public function testSearch(
        string $sql,
        array $expectedFilters,
        string $text,
        ?int $limit,
        ?int $offset,
        ?string $sortBy,
        ?array $filters
    )
    {
        $adapter = $this->createMock(DatabaseAdapterInterface::class);

        $adapter->expects($this->once())
            ->method('execute')
            ->with($sql, $expectedFilters)
            ->willReturn(['test']);

        $planner = new SqlQueryPlanner($adapter);

        $this->assertSame(
            ['test'],
            $planner->search($text, $limit, $offset, $sortBy, $filters)
        );
    }

    public function queryParams(): array
    {
        return [
            [
                'SELECT * FROM product WHERE title LIKE :title',
                ['title' => '%foo%'],
                'foo',
                null,
                null,
                null,
                null,
            ],
            [
                'SELECT * FROM product WHERE title LIKE :title AND brand = :brand',
                ['title' => '%foo%', 'brand' => 'bar'],
                'foo',
                null,
                null,
                null,
                ['brand' => 'bar'],
            ],
            [
                'SELECT * FROM product WHERE title LIKE :title LIMIT 10, 5',
                ['title' => '%foo%'],
                'foo',
                5,
                10,
                null,
                null,
            ],
            [
                'SELECT * FROM product WHERE title LIKE :title ORDER BY bar ASC',
                ['title' => '%foo%'],
                'foo',
                null,
                null,
                'bar',
                null,
            ],
            [
                'SELECT * FROM product WHERE title LIKE :title AND test = :test ORDER BY bar ASC LIMIT 3, 100',
                ['title' => '%foo%', 'test' => 'filter'],
                'foo',
                100,
                3,
                'bar',
                ['test' => 'filter'],
            ],
        ];
    }
}
