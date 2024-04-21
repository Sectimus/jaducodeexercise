<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @coversDefaultClass \App\Controller\CheckerController
 */
final class CheckerControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->createClient();
        $this->client = $this->getClient();
    }

    /**
     * @group integration
     * @covers ::palindrome
     */
    public function testPalindromeValidationIntegration()
    {
        $this->client->request("POST", "/palindrome/validate", [], [], [], json_encode(["word" => "anna"]));

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $response = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertTrue($response["pass"]);
    }

    /**
     * @group integration
     * @covers ::anagram
     */
    public function testAnagramValidationIntegration()
    {
        $this->client->request("POST", "/anagram/validate", [], [], [], json_encode(["word" => "coalface", "comparison" => "cacao elf"]));

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $response = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertTrue($response["pass"]);
    }

    /**
     * @group integration
     * @covers ::pangram
     */
    public function testPangramValidationIntegration()
    {
        $this->client->request("POST", "/pangram/validate", [], [], [], json_encode(["phrase" => "The quick brown fox jumps over the lazy dog"]));

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $response = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertTrue($response["pass"]);
    }
}
