<?php
declare(strict_types = 1);

namespace App\SearchEngine\Creator;

use App\SearchEngine\Adapter\DoctrineAdapter;
use App\SearchEngine\Planner\SqlQueryPlanner;
use App\SearchEngine\SearchEngine;
use Doctrine\ORM\EntityManagerInterface;

/*
 * This class applies Facade Pattern to creation of SearchEngine
 */
class SearchEngineCreator
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(): SearchEngine
    {
        $adapter = new DoctrineAdapter($this->entityManager);
        $queryPlanner = new SqlQueryPlanner($adapter);
        return new SearchEngine($queryPlanner);
    }
}
