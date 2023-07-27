<?php

namespace Hard2Code\Service\Captcha;

use Hard2Code\Exception\CaptchaVerifyException;

interface CaptchaService
{
    /**
     * @param  string  $privateKey
     * @param  string  $token
     *
     * @return void
     * @throws CaptchaVerifyException
     */
    public function verify(string $privateKey, string $token): void;

    /**
     * @return bool
     */
    public function isBot(): bool;

    /**
     * @return bool
     */
    public function isSuccessVerified(): bool;

    /**
     * @return string
     */
    public function getError(): string;

    /**
     * @return string
     */
    public function getIpAddress(): string;

    /**
     * @return array
     */
    public function getResult(): array;


}
