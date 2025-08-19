<?php

namespace Omnipay\Powerboard\Message\Card;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Powerboard\Message\Card\AbstractCardRequest;

class AuthenticateRequest extends AbstractCardRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'authenticationToken',
            'returnUrl',
        );

        return [];
    }

    /**
     * @return mixed
     */
    public function getAuthenticationToken()
    {
        return $this->getParameter('authenticationToken');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setAuthenticationToken($value)
    {
        return $this->setParameter('authenticationToken', $value);
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\Powerboard\Message\Card\AuthenticateResponse::class;
    }

    /**
     * @inheritDoc
     */
    public function sendData($data)
    {
        return $this->makeResponse([
            'authenticationToken' => $this->getAuthenticationToken(),
            'sdkJsUrl' => $this->getSdkJsUrl(),
        ]);
    }
}
