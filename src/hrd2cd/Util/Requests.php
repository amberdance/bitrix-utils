<?php

namespace Hard2Code\Util;

use Hard2Code\Exception\HttpException;

final class Requests
{
    /**
     * @param  string      $url
     * @param  array|null  $params
     * @param  array|null  $headers
     *
     * @return array
     * @throws HttpException
     */
    public static function get(string $url, ?array $params = null, ?array $headers = null, int $timeout = 60): array
    {
        return self::initCurl($url, "GET", $params, $headers, $timeout);
    }

    /**
     * @param  string      $url
     * @param  array|null  $params
     * @param  array|null  $headers
     *
     * @return array
     * @throws HttpException
     */
    public static function post(string $url, ?array $params = null, ?array $headers = null, int $timeout = 60): array
    {
        return self::initCurl($url, "POST", $params, $headers, $timeout);
    }

    /**
     * @param  string      $url
     * @param  string      $requestMethod
     * @param  array|null  $params
     * @param  array|null  $headers
     *
     * @return array
     * @throws HttpException
     */
    private static function initCurl(
        string $url,
        string $requestMethod,
        ?array $params = null,
        ?array $headers = null,
        ?int $timeout = 60,
    ): array {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => $timeout,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => $requestMethod,
            CURLOPT_HTTPHEADER     => $headers ?? [],
        ]);

        if ($requestMethod == "POST") {
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($params) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            }
        }

        if ($requestMethod == "GET" && $params) {
            $queryString = "?".http_build_query($params);
            curl_setopt($curl, CURLOPT_URL, $url.$queryString);
        }

        $response = curl_exec($curl);

        if ($response === false) {
            throw new HttpException("cURL request failed: ".curl_error($curl));
        }

        curl_close($curl);

        return json_decode($response, true);
    }
}
