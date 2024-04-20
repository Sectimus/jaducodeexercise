<?php

namespace App\Service;

use  App\Service\CheckerInterface;

class CheckerService implements CheckerInterface
{
    private const ALPHABET = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
    ];

    public function isPalindrome(string $word): bool
    {
        $word = $this->prep($word);

        return $word === strrev($word);
    }

    public function isAnagram(string $word, string $comparison): bool
    {
        $word = $this->prep($word);
        $comparison = $this->prep($comparison);

        return count_chars($word, 1) === count_chars($comparison, 1);
    }

    public function isPangram(string $phrase): bool
    {
        $phrase = $this->prep($phrase);
        $characterSet = str_split($phrase);
        $characterSet = array_unique($characterSet);
        $characterSet = array_intersect($characterSet, self::ALPHABET);
        return count($characterSet) === count(self::ALPHABET);
    }

    /**
     * Prepares the provided string for usage in the service
     */
    private function prep(string $string): string
    {
        //remove any spaces from the word and comparison as they are not evaluated as part of an anagram
        $string = str_replace(' ', '', $string);

        //drop all characters to lowercase to ensure case insensitivity
        $string = strtolower($string);

        return $string;
    }
}
