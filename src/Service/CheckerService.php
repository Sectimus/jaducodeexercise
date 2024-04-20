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
        return $word === strrev($word);
    }

    public function isAnagram(string $word, string $comparison): bool
    {
        //remove any spaces from the word and comparison as they are not evaluated as part of an anagram
        $word = str_replace(' ', '', $word);
        $comparison = str_replace(' ', '', $comparison);

        //drop all characters to lowercase to ensure case insensitivity
        $word = strtolower($word);
        $comparison = strtolower($comparison);


        return count_chars($word, 1) === count_chars($comparison, 1);
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
