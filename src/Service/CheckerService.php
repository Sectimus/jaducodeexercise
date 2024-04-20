<?php

namespace App\Service;

use  App\Service\CheckerInterface;

class CheckerService implements CheckerInterface
{
    public function isPalindrome(string $word): bool
    {
        return false;
    }

    public function isAnagram(string $word, string $comparison): bool
    {
        //remove any spaces from the word and comparison as they are not evaluated as part of an anagram
        $word = str_replace(' ', '', $word);
        $comparison = str_replace(' ', '', $comparison);

        //drop all characters to lowercase to ensure case insensitivity
        $word = strtolower($word);
        $comparison = strtolower($word);

        return count_chars($word, 1) === count_chars($comparison, 1);
    }

    public function isPangram(string $phrase): bool
    {
        return false;
    }
}
