<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

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
        // Valid palindrome
        $response = $this->makeRequest("POST", "/palindrome/validate", ["word" => "anna"]);

        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode($response->getContent(), true);
        $this->assertTrue($body["pass"]);

        // Invalid palindrome
        $response = $this->makeRequest("POST", "/palindrome/validate", ["word" => "Bark"]);

        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode($response->getContent(), true);
        $this->assertFalse($body["pass"]);
    }

    /**
     * @group integration
     * @covers ::palindrome
     */
    public function testPalindromeInvalidRequestIntegration()
    {
        // Invalid request method
        $response = $this->makeRequest("GET", "/palindrome/validate", ["word" => "anna"]);
        $this->assertEquals(405, $response->getStatusCode());

        // Missing required JSON keys
        $response = $this->makeRequest("POST", "/palindrome/validate", ["someword" => "anna"]);

        $this->assertEquals(400, $response->getStatusCode());
        $body = json_decode($response->getContent(), true);
        $this->assertFalse($body["pass"]);

        // Invalid request body
        $response = $this->makeRequest("POST", "/palindrome/validate", "", false);

        $this->assertEquals(400, $response->getStatusCode());
        $body = json_decode($response->getContent(), true);
        $this->assertFalse($body["pass"]);
    }

    /**
     * @group integration
     * @covers ::anagram
     */
    public function testAnagramValidationIntegration()
    {

        // Valid anagram
        $response = $this->makeRequest("POST", "/anagram/validate", ["word" => "coalface", "comparison" => "cacao elf"]);

        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode($response->getContent(), true);
        $this->assertTrue($body["pass"]);

        // Invalid anagram
        $response = $this->makeRequest("POST", "/anagram/validate", ["word" => "coalface", "comparison" => "dark elf"]);

        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode($response->getContent(), true);
        $this->assertFalse($body["pass"]);
    }

    /**
     * @group integration
     * @covers ::anagram
     */
    public function testAnagramInvalidRequestIntegration()
    {
        // Invalid request method
        $response = $this->makeRequest("GET", "/anagram/validate", ["phrase" => "The quick brown fox jumps over the lazy dog"]);
        $this->assertEquals(405, $response->getStatusCode());

        // Missing required JSON keys
        $response = $this->makeRequest("POST", "/anagram/validate", ["catchphrase" => "The quick brown fox jumps over the lazy dog"]);

        $this->assertEquals(400, $response->getStatusCode());
        $body = json_decode($response->getContent(), true);
        $this->assertFalse($body["pass"]);

        // Invalid request body
        $response = $this->makeRequest("POST", "/anagram/validate", "", false);

        $this->assertEquals(400, $response->getStatusCode());
        $body = json_decode($response->getContent(), true);
        $this->assertFalse($body["pass"]);
    }

    /**
     * @group integration
     * @covers ::pangram
     */
    public function testPangramValidationIntegration()
    {

        // Valid pangram
        $response = $this->makeRequest("POST", "/pangram/validate", ["phrase" => "The quick brown fox jumps over the lazy dog"]);

        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode($response->getContent(), true);
        $this->assertTrue($body["pass"]);

        // Invalid pangram
        $response = $this->makeRequest("POST", "/pangram/validate", ["phrase" => "The British Broadcasting Corporation (BBC) is a British public service broadcaster."]);

        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode($response->getContent(), true);
        $this->assertFalse($body["pass"]);
    }

    /**
     * @group integration
     * @covers ::pangram
     */
    public function testPangramInvalidRequestIntegration()
    {
        // Invalid request method
        $response = $this->makeRequest("GET", "/pangram/validate", ["phrase" => "The quick brown fox jumps over the lazy dog"]);
        $this->assertEquals(405, $response->getStatusCode());

        // Missing required JSON keys
        $response = $this->makeRequest("POST", "/pangram/validate", ["catchphrase" => "The quick brown fox jumps over the lazy dog"]);

        $this->assertEquals(400, $response->getStatusCode());
        $body = json_decode($response->getContent(), true);
        $this->assertFalse($body["pass"]);

        // Invalid request body
        $response = $this->makeRequest("POST", "/pangram/validate", "", false);

        $this->assertEquals(400, $response->getStatusCode());
        $body = json_decode($response->getContent(), true);
        $this->assertFalse($body["pass"]);
    }

    private function makeRequest(string $method, string $uri, $data, bool $parseJsonBody = true): Response
    {
        $this->client->request($method, $uri, [], [], [], $parseJsonBody ? json_encode($data) : $data);
        return $this->client->getResponse();
    }
}
