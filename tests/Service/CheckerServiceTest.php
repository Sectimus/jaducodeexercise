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
}