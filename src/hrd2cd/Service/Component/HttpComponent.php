<?php

namespace Hard2Code\Service\Component;

use Bitrix\Main\ArgumentTypeException;
use Bitrix\Main\Component\ParameterSigner;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\Response\AjaxJson;
use Bitrix\Main\Error;
use Bitrix\Main\Result;
use Bitrix\Main\Security\Sign\BadSignatureException;
use CBitrixComponent;
use Hard2Code\Util\Sanitizer;
use Hard2Code\Util\Signer;

abstract class HttpComponent extends CBitrixComponent implements Controllerable
{


    /**
     * @return array
     */
    abstract public function configureActions(): array;

    /**
     * @param  mixed  $message
     *
     * @return AjaxJson
     */
    protected function successMessage(mixed $message = null): AjaxJson
    {
        return AjaxJson::createSuccess($message ?? "success");
    }

    /**
     * @param  string  $message
     *
     * @return AjaxJson
     */
    protected function errorMessage(string $message): AjaxJson
    {
        $result = new Result();
        $result->addError(new Error($message));
        $errors = $result->getErrorCollection();

        return AjaxJson::createError($errors);
    }

    /**
     * @param  string  $signedString
     * @param  string  $key
     *
     * @return string|null
     * @throws ArgumentTypeException
     * @throws BadSignatureException
     */
    protected function decodeComponentParamsByKey(string $signedString, string $key): ?string
    {
        return ParameterSigner::unsignParameters($this->getName(), $signedString)[$key];
    }

    /**
     * @param  string       $key
     * @param  string|null  $postField
     *
     * @return string|null
     * @throws ArgumentTypeException
     * @throws BadSignatureException
     */
    protected function decodeComponentParamsFromPostFieldByKey(
        string $key,
        ?string $postField = Signer::SIGN_PARAMS_KEY
    ): ?string {
        return $this->decodeComponentParams($this->getPostParam($postField))[$key] ?? null;
    }

    /**
     * @throws ArgumentTypeException
     * @throws BadSignatureException
     */
    protected function decodeComponentParams(string $signedString = Signer::SIGN_PARAMS_KEY): array
    {
        return ParameterSigner::unsignParameters($this->getName(), $signedString);
    }

    /**
     * @param  string  $key
     *
     * @return string|null
     */
    protected function getPostParam(string $key): ?string
    {
        return $_POST[$key] ?? null;
    }

    /**
     * @param  string  $key
     *
     * @return array
     * @throws ArgumentTypeException
     * @throws BadSignatureException
     */
    protected function decodeComponentParamsFromPostField(string $key = Signer::SIGN_PARAMS_KEY): array
    {
        return $this->decodeComponentParams($this->getPostParam($key));
    }

    /**
     * @param  string  ...$keys
     *
     * @return array
     */
    protected function getPostParams(string ...$keys): array
    {
        $result = [];

        foreach ($keys as $i => $key) {
            if ($_POST[$key] == null) {
                continue;
            }

            $result[$key] = $_POST[$key];
        }

        return $result;
    }

    /**
     * @param  string  $key
     *
     * @return string|null
     */
    protected function getSanitizedPostParam(string $key): ?string
    {
        return Sanitizer::sanitize($_POST[$key]) ?? null;
    }

}
