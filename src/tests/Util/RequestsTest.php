<?php

namespace Hard2Code\Tests\Util;

use Hard2Code\Exception\HttpException;
use Hard2Code\Util\Requests;
use PHPUnit\Framework\TestCase;

class RequestsTest extends TestCase
{

    private static string $validUrl = "https://jsonplaceholder.typicode.com/posts/1";
    private static string $invalidUrl = "http://dewf32f.f34fsdf-333.com/";

    private static string $timeOutUrl = "https://aws.amazon.com/s3/";

    /**
     * @return void
     * @throws HttpException
     */
    public function testGetThrowsHttpExceptionOnWhenDownloadingLongTime()
    {
        $this->expectException(HttpException::class);;
        Requests::get(self::$timeOutUrl);
    }

    /**
     * @return void
     * @throws HttpException
     */
    public function testPostThrowsHttpExceptionOnWhenDownloadingLongTime()
    {
        $this->expectException(HttpException::class);
        Requests::post(self::$timeOutUrl);
    }

    /**
     * @return void
     * @throws HttpException
     */
    public function testGetThrowsHttpExceptionOnInvalidUrl()
    {
        $this->expectException(HttpException::class);
        Requests::get(self::$invalidUrl);
    }

    /**
     * @return void
     * @throws HttpException
     */
    public function testPostThrowsHttpExceptionOnInvalidUrl()
    {
        $this->expectException(HttpException::class);
        Requests::post(self::$invalidUrl);
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
        $response = Requests::get(self::$validUrl, null, null, 120);
        $this->assertNotEquals(HttpException::class, $response);
        $this->assertIsArray($response);
    }
}
