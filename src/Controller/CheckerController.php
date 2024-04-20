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

    #[Route('/pangram/validate', name: 'check pangram', methods: ['POST'])]
    public function pangram(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        if ($json === null || !isset($json['phrase'])) {
            //failed to decode json, possible non-json payload provided
            return $this->invalidContent("Please ensure you provide a valid JSON payload with a \"phrase\" key.");
        }

        $phrase = $json['phrase'];

        if (!$this->checkerService->isPangram($phrase)) {
            return new Response(
                "The phrase: \"" . $phrase . "\" is NOT a pangram.",
                Response::HTTP_OK
            );
        }

        return new Response(
            "The phrase: \"" . $phrase . "\" is a pangram.",
            Response::HTTP_OK
        );
    }

    private function invalidContent(?string $message = null): Response
    {
        return new Response(
            $message ?? 'Invalid content',
            Response::HTTP_BAD_REQUEST
        );
    }
}
