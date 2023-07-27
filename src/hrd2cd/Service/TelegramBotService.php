<?php


namespace Hard2Code\Service;

use Hard2Code\Exception\TelegramBotException;

interface TelegramBotService
{

    public const TELEGRAM_API_URL = "https://api.telegram.org/";


    /**
     * @param  string  $chatId
     * @param  string  $text
     *
     * @return void
     * @throws TelegramBotException
     */
    public function sendMessage(string $chatId, string $text): void;
}
