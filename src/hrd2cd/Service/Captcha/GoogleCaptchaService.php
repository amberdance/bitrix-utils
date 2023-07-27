<?php

namespace Hard2Code\Service\Captcha;

use Hard2Code\Util\Requests;

class GoogleCaptchaService implements CaptchaService
{
    public const ACCEPTABLE_HUMAN_SCORE = 0.9;
    public const VERIFY_URL = "https://www.google.com/recaptcha/api/siteverify";
    public const API_JS_URL = "https://www.google.com/recaptcha/api.js";
    private bool $isBot = false;
    private bool $isSuccess = false;
    private string $error;
    private string $ipAddress;
    private array $result;


    /**
     * @param  string  $publicKey
     *
     * @return string
     */
    public static function getRecaptchaJsApiUrl(string $publicKey): string
    {
        return self::API_JS_URL."?render=$publicKey";
    }

    /**
     * @inheritDoc
     */
    public function verify(string $privateKey, string $token): void
    {
        $this->clearContext();

        $ip = $_SERVER["REMOTE_ADDR"];
        $this->ipAddress = $ip;

        $params = [
            "secret"   => $privateKey,
            "response" => $token,
            "remoteip" => $ip,
        ];

        $result = Requests::post(self::VERIFY_URL, $params);

        $this->checkSuccessField($result);
        $this->checkHumanScoreField($result["score"]);

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

    /**
     * @return void
     */
    private function clearContext(): void
    {
        $this->isBot = false;
        $this->isSuccess = false;
        $this->error = "";
        $this->ipAddress = "";
    }

    /**
     * @param  array  $result
     *
     * @return void
     */
    private function checkSuccessField(array $result): void
    {
        if ($result["success"]) {
            $this->isSuccess = true;
        } else {
            $this->isSuccess = false;
            $this->error = $result["error-codes"][0];
        }
    }

    /**
     * @param  float|null  $score
     *
     * @return void
     */
    private function checkHumanScoreField(?float $score): void
    {
        if ($score != null && $score < self::ACCEPTABLE_HUMAN_SCORE) {
            $this->isBot = true;
        }
    }
}
