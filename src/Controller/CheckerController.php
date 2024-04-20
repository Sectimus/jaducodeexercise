<?php

namespace App\Controller;

use App\Service\CheckerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CheckerController extends AbstractController
{
    private CheckerService $checkerService;

    public function __construct(CheckerService $checkerService)
    {
        $this->checkerService = $checkerService;
    }

    private function invalidContent(?string $message = null): Response
    {
        return new Response(
            $message ?? 'Invalid content',
            Response::HTTP_BAD_REQUEST
        );
    }
}
