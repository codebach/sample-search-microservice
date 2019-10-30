<?php
declare(strict_types = 1);

namespace App\Tests\SearchEngine;

use App\SearchEngine\Planner\AbstractQueryPlanner;
use App\SearchEngine\SearchEngine;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class SearchEngineTest extends TestCase
{
    public function testSearch(): void
    {
        $planner = $this->planerExpects('foo', 3, 0, null, null);

        $engine = new SearchEngine($planner);

        $this->assertSame(['bar'], $engine->search('foo'));
    }

    public function testSetPage(): void
    {
        $planner = $this->planerExpects('test', 3, 3, null, null);

        $engine = new SearchEngine($planner);
        $engine->setPagination(2);

        $this->assertSame(['bar'], $engine->search('test'));
    }

    public function testSetFilters(): void
    {
        $planner = $this->planerExpects('test', 3, 0, null, ['foo' => 'bar']);

        $engine = new SearchEngine($planner);
        $engine->applyFilters(['foo' => 'bar']);

        $this->assertSame(['bar'], $engine->search('test'));
    }

    public function testSortBy(): void
    {
        $planner = $this->planerExpects('test', 3, 0, 'foo', null);

        $engine = new SearchEngine($planner);
        $engine->sortBy('foo');

        $this->assertSame(['bar'], $engine->search('test'));
    }

    private function planerExpects(string $text, int $limit, int $offset, ?string $sort, ?array $filters): MockObject
    {
        $planner = $this->createMock(AbstractQueryPlanner::class);

        $planner->expects($this->once())
            ->method('search')
            ->with($text, $limit, $offset, $sort, $filters)
            ->willReturn(['bar']);

        return $planner;
    }
}
