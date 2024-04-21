<?php

namespace App\Controller;

use App\Service\CheckerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Controller for interacting with the CheckerService to validate palindromes, anagrams and pangrams. Route: /{type}/validate
 */
class CheckerController extends AbstractController
{
    private CheckerService $checkerService;

    public function __construct(CheckerService $checkerService)
    {
        $this->checkerService = $checkerService;
    }

    /**
     * Validates if the provided word is a palindrome.
     * Request body should be a JSON object with a 'word' key.
     * @param Request $request
     * @return Response
     */
    #[Route('/palindrome/validate', name: 'check palindrome', methods: ['POST'])]
    public function palindrome(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        if ($json === null || !isset($json['word'])) {
            //failed to decode json, possible non-json payload provided
            return $this->invalidContent("Please ensure you provide a valid JSON payload with a 'word' key.");
        }

        $word = $json['word'];

        if (!$this->checkerService->isPalindrome($json['word'])) {
            return new Response(
                "The word: \"" . $word . "\" is NOT a palindrome.",
                Response::HTTP_OK
            );
        }

        return new Response(
            "The word: \"" . $word . "\" is a palindrome.",
            Response::HTTP_OK
        );
    }

    /**
     * Validates if the provided word is an anagram of the comparison word.
     * Request body should be a JSON object with 'word' and 'comparison' keys.
     * @param Request $request
     * @return Response
     */
    #[Route('/anagram/validate', name: 'check anagram', methods: ['POST'])]
    public function anagram(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        if ($json === null || !(isset($json['word']) && isset($json['comparison']))) {
            //failed to decode json, possible non-json payload provided
            return $this->invalidContent("Please ensure you provide a valid JSON payload with a \"word\" and \"comparison\" key.");
        }

        $word = $json['word'];
        $comparison = $json['comparison'];

        if (!$this->checkerService->isAnagram($word, $comparison)) {
            return new Response(
                "The word: \"" . $word . "\" is NOT an anagram of \"" . $comparison . "\".",
                Response::HTTP_OK
            );
        }

        return new Response(
            "The word: \"" . $word . "\" is an anagram of \"" . $comparison . "\".",
            Response::HTTP_OK
        );
    }

    /**
     * Validates if the provided phrase is a pangram.
     * Request body should be a JSON object with a 'phrase' key.
     * @param Request $request
     * @return Response
     */
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

    /**
     * Returns a shared response indicating invalid content was provided to the action.
     * If a $message parameter is provided, it will be used, otherwise a default message is used.
     * @param string|null $message
     * @return Response
     */
    protected function invalidContent(?string $message = null): Response
    {
        return new Response(
            $message ?? 'Invalid content.',
            Response::HTTP_BAD_REQUEST
        );
    }
}
