<?php

namespace App\Tests\Service;

use App\Service\CheckerService;
use PHPUnit\Framework\TestCase;

class CheckerServiceTest extends TestCase
{
    private CheckerService $instance;

    protected function setUp(): void
    {
        $this->instance = new CheckerService();
    }

    public function testIsPalindrome()
    {
        $result = $this->instance->isPalindrome('anna');
        $this->assertTrue($result);

        $result = $this->instance->isPalindrome('bark');
        $this->assertFalse($result);
    }

    public function testIsAnagram()
    {
        $result = $this->instance->isAnagram('coalface', 'cacao elf');
        $this->assertTrue($result);

        $result = $this->instance->isAnagram('coalface', 'dark elf');
        $this->assertFalse($result);
    }

    public function testIsPangram()
    {
        $result = $this->instance->isPangram('The quick brown fox jumps over the lazy dog');
        $this->assertTrue($result);

        $result = $this->instance->isPangram('The British Broadcasting Corporation (BBC) is a British public service broadcaster.');
        $this->assertFalse($result);
    }
}
