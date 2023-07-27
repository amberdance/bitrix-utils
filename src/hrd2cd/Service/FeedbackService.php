<?php

namespace Hard2Code\Service;

use Bitrix\Main\Engine\Response\AjaxJson;

interface FeedbackService
{
    /**
     * @return AjaxJson
     */
    public function sendMessageAction(): AjaxJson;

}
