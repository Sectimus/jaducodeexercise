<?php

namespace App\Service;

use App\CheckerInterface;

class CheckerService implements CheckerInterface
{
    public function isPalindrome(string $word): bool
    {
        return $word === strrev($word);
    }

    public function isAnagram(string $word, string $comparison): bool
    {
        return false;
    }

    public function isPangram(string $phrase): bool
    {
        return false;
    }
}
