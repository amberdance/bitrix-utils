<?php

namespace Hard2Code\Service\Captcha;

use Hard2Code\Util\Requests;

class YandexCaptchaService implements CaptchaService
{

    public const VERIFY_URL = "https://smartcaptcha.yandexcloud.net/validate";
    public const API_JS_URL = "https://smartcaptcha.yandexcloud.net/captcha.js?render=onload";

    private bool $isBot = false;
    private bool $isSuccess = false;
    private string $error;
    private string $ipAddress;
    private array $result;


    /**
     * @inheritDoc
     */
    public function verify(string $privateKey, string $token): void
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->ipAddress = $ip;

        $params = [
            "secret" => $privateKey,
            "token"  => $token,
            "ip"     => $ip,
        ];

        $result = Requests::get(self::VERIFY_URL, $params);

        if ($result["status"] !== "ok") {
            $this->isBot = true;
            $this->error = $result["message"];
        }

        $this->result = $result;
    }

    /**
     * @inheritDoc
     */
    public function isBot(): bool
    {
        return $this->isBot;
    }

    /**
     * @inheritDoc
     */
    public function isSuccessVerified(): bool
    {
        return $this->isSuccess;
    }

    /**
     * @inheritDoc
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @inheritDoc
     */
    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }


    /**
     * @inheritDoc
     */
    public function getResult(): array
    {
        return $this->result;
    }
}
