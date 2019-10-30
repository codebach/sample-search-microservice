<?php
declare(strict_types = 1);

namespace App\Controller\API\V1;

use App\Input\ParamReader;
use App\SearchEngine\Creator\SearchEngineCreator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchApiControllerV1
{
    private $creator;

    public function __construct(SearchEngineCreator $creator)
    {
        $this->creator = $creator;
    }

    /**
     * @Route("/api/v1/search")
     *
     * @todo: use try/catch and prepare response for exceptions
     */
    public function search(Request $request): JsonResponse
    {
        $reader = new ParamReader($request);
        $searchEngine = $this->creator->create();

        if ($reader->hasFilters()) {
            $searchEngine->applyFilters($reader->getFilters());
        }

        if ($reader->hasSortBy()) {
            $searchEngine->sortBy($reader->getSortBy());
        }

        $products = $searchEngine
            ->setPagination($reader->getPage())
            ->search($reader->getQuery());

        $response = new JsonResponse();

        $response->setData([
            'query' => $reader->getQuery(),
            'current_page' => $reader->getPage(),
            'total_page' => $searchEngine->getPageCount($reader->getQuery()),
            'sort_by' => $reader->getSortBy(),
            'filter' => $reader->getFilters(),
            'products' => $products,
        ]);

        return $response;
    }
}
