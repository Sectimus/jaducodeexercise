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
        return false;
    }

    public function isAnagram(string $word, string $comparison): bool
    {
        return false;
    }

    public function isPangram(string $phrase): bool
    {
        /*remove any spaces from the word and comparison as they are not evaluated as part of a pangram
          and drop all characters to lowercase to ensure case insensitivity*/
        $phrase = strtolower(str_replace(' ', '', $phrase));
        $characterSet = str_split($phrase);
        $characterSet = array_unique($characterSet);
        $characterSet = array_intersect($characterSet, self::ALPHABET);
        return count($characterSet) === count(self::ALPHABET);
    }
}
