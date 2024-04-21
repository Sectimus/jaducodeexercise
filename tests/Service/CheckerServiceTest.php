<?php

namespace App\Tests\Service;

use App\Service\CheckerService;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Service\CheckerService
 */
final class CheckerServiceTest extends TestCase
{
    private CheckerService $instance;

    protected function setUp(): void
    {
        $this->instance = new CheckerService();
    }

    /**
     * @covers ::isPalindrome
     */
    public function testIsPalindrome()
    {
        $result = $this->instance->isPalindrome('anna');
        $this->assertTrue($result);

        $result = $this->instance->isPalindrome('bark');
        $this->assertFalse($result);
    }

    /**
     * @covers ::isAnagram
     */
    public function testIsAnagram()
    {
        $result = $this->instance->isAnagram('coalface', 'cacao elf');
        $this->assertTrue($result);

        $result = $this->instance->isAnagram('coalface', 'dark elf');
        $this->assertFalse($result);
    }

    /**
     * @covers ::isPangram
     */
    public function testIsPangram()
    {
        $result = $this->instance->isPangram('The quick brown fox jumps over the lazy dog');
        $this->assertTrue($result);

        $result = $this->instance->isPangram('The British Broadcasting Corporation (BBC) is a British public service broadcaster.');
        $this->assertFalse($result);
    }
}
