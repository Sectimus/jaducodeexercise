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
        return false;
    }

    public function isPangram(string $phrase): bool
    {
        return false;
    }
}
