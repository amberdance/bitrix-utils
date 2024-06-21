<?php

namespace Hard2Code\Tests\Util;

use Hard2Code\Exception\HttpException;
use Hard2Code\Util\Requests;
use PHPUnit\Framework\TestCase;

class RequestsTest extends TestCase
{

    private static string $validUrl = "https://jsonplaceholder.typicode.com/posts/1";
    private static string $invalidUrl = "http://invalid-url.com";
    private static string $timeOutUrl = "https://aws.amazon.com/s3/";

    public function testGetThrowsHttpExceptionOnInvalidUrl()
    {
        $this->expectException(HttpException::class);
        Requests::get(self::$invalidUrl);
    }

    public function testPostThrowsHttpExceptionOnInvalidUrl()
    {
        $this->expectException(HttpException::class);
        Requests::post(self::$invalidUrl);
    }

    public function testGetThrowsHttpExceptionOnWhenDownloadingLongTime()
    {
        $this->expectException(HttpException::class);;
        Requests::get(self::$timeOutUrl);
    }

    public function testPostThrowsHttpExceptionOnWhenDownloadingLongTime()
    {
        $this->expectException(HttpException::class);
        Requests::post(self::$timeOutUrl);
    }

    /**
     * @throws HttpException
     */
    public function testGetRequestWithValidUrl()
    {
        $response = Requests::get(self::$validUrl);
        $this->assertNotEquals(HttpException::class, $response);
        $this->assertIsArray($response);
    }

    /**
     * @throws HttpException
     */
    public function testGetRequestWithValidUrlAndCustomTimeout()
    {
        $timeout = 2;
        $response = Requests::get(self::$validUrl, null, null, $timeout);
        $this->assertNotEquals(HttpException::class, $response);
        $this->assertIsArray($response);
    }
}
