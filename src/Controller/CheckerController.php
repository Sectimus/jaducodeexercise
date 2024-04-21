<?php

namespace App\Controller;

use App\Service\CheckerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @return JsonResponse
     */
    #[Route('/palindrome/validate', name: 'check palindrome', methods: ['POST'])]
    public function palindrome(Request $request): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        if ($json === null || !isset($json['word'])) {
            //failed to decode json, possible non-json payload provided
            return $this->invalidContent("Please ensure you provide a valid JSON payload with a 'word' key.");
        }

        $word = $json['word'];

        if (!$this->checkerService->isPalindrome($json['word'])) {
            return $this->buildResponse("The word: '" . $word . "' is NOT a palindrome.", false);
        }

        return $this->buildResponse("The word: '" . $word . "' is a palindrome.", true);
    }

    /**
     * Validates if the provided word is an anagram of the comparison word.
     * Request body should be a JSON object with 'word' and 'comparison' keys.
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/anagram/validate', name: 'check anagram', methods: ['POST'])]
    public function anagram(Request $request): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        if ($json === null || !(isset($json['word']) && isset($json['comparison']))) {
            //failed to decode json, possible non-json payload provided
            return $this->invalidContent("Please ensure you provide a valid JSON payload with a 'word' and 'comparison' key.");
        }

        $word = $json['word'];
        $comparison = $json['comparison'];

        if (!$this->checkerService->isAnagram($word, $comparison)) {
            return $this->buildResponse("The word: '" . $word . "' is NOT an anagram of '$comparison'.", false);
        }

        return $this->buildResponse("The word: '" . $word . "' is an anagram of '$comparison'.", true);
    }

    /**
     * Validates if the provided phrase is a pangram.
     * Request body should be a JSON object with a 'phrase' key.
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/pangram/validate', name: 'check pangram', methods: ['POST'])]
    public function pangram(Request $request): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        if ($json === null || !isset($json['phrase'])) {
            //failed to decode json, possible non-json payload provided
            return $this->invalidContent("Please ensure you provide a valid JSON payload with a 'phrase' key.");
        }

        $phrase = $json['phrase'];

        if (!$this->checkerService->isPangram($phrase)) {
            return $this->buildResponse("The phrase: '" . $phrase . "' is NOT a pangram.", false);
        }

        return $this->buildResponse("The phrase: '" . $phrase . "' is a pangram.", true);
    }

    /**
     * Returns a shared response indicating invalid content was provided to the action.
     * If a $message parameter is provided, it will be used, otherwise a default message is used.
     * @param string|null $message
     * @return JsonResponse
     */
    protected function invalidContent(?string $message = null): JsonResponse
    {
        return new JsonResponse([
            'message' => $message ?? 'Invalid content.',
            'pass' => false
        ], JsonResponse::HTTP_BAD_REQUEST);
    }

    /**
     * Builds a JSON response with a message and a pass boolean indicating if the parameter(s) matched the called check function.
     * @param string $message
     * @param bool $pass
     * @return JsonResponse
     */
    protected function buildResponse(string $message, bool $pass): JsonResponse
    {
        return new JsonResponse([
            'message' => $message,
            'pass' => $pass
        ], JsonResponse::HTTP_OK);
    }
}
