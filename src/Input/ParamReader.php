<?php
declare(strict_types = 1);

namespace App\Input;

use Symfony\Component\HttpFoundation\Request;

/*
 * @todo: throw exceptions when input is not valid
 */
class ParamReader
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getQuery(): string
    {
        return $this->request->query->get('query');
    }

    public function getPage(): int
    {
        $page = (int) $this->request->query->get('page');

        if (0 == $page) {
            return 1;
        }

        return $page;
    }

    /*
     * @todo: accept multiple filter params
     */
    public function getFilters(): array
    {
        $filters = [];

        $filter = $this->request->query->get('filter');

        $filterArray = explode(':', $filter);

        if (isset($filterArray[1]) && "" != $filterArray[1]) {
            $filters = [$filterArray[0] => $filterArray[1]];
        }

        return $filters;
    }

    public function hasFilters(): bool
    {
        $filter = $this->request->query->get('filter');

        $filterArray = explode(':', $filter);

        return isset($filterArray[1]);
    }

    public function hasSortBy(): bool
    {
        $sortBy = $this->request->query->get('sort_by');

        return "" != $sortBy;
    }

    public function getSortBy(): string
    {
        return $this->request->query->get('sort_by');
    }
}
