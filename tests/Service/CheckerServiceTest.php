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
     * @group unit
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
     * @group unit
     * @covers ::isPalindrome
     */
    public function testIsPalindromeWithStrippedData()
    {
        $result = $this->instance->isPalindrome('a4£n3 n 1a');
        $this->assertTrue($result);
    }

    /**
     * @group unit
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
     * @group unit
     * @covers ::isAnagram
     */
    public function testIsAnagramWithStrippedData()
    {
        $result = $this->instance->isAnagram('coa1$lf a c e', 'c1 aca!o elf');
        $this->assertTrue($result);
    }

    /**
     * @group unit
     * @covers ::isPangram
     */
    public function testIsPangram()
    {
        $result = $this->instance->isPangram('The quick brown fox jumps over the lazy dog');
        $this->assertTrue($result);

        $result = $this->instance->isPangram('The British Broadcasting Corporation (BBC) is a British public service broadcaster.');
        $this->assertFalse($result);
    }

    /**
     * @group unit
     * @covers ::isPangram
     */
    public function testIsPangramWithStrippedData()
    {
        $result = $this->instance->isPangram('The 1quic£k b3rown fox2 jumps4overthe lazydog');
        $this->assertTrue($result);
    }
}
