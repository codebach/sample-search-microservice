<?php

namespace App\Controller\UI;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function search(): Response
    {
        return $this->render('search.html.twig');
    }
}
