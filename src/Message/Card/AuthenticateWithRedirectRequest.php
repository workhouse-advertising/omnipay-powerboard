<?php

namespace Omnipay\Powerboard\Message\Card;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Powerboard\Message\Card\AuthenticateRequest;

class AuthenticateWithRedirectRequest extends AuthenticateRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'returnUrl',
        );

        return parent::getData();
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\Powerboard\Message\Card\AuthenticateWithRedirectResponse::class;
    }

    /**
     * @inheritDoc
     */
    public function sendData($data)
    {
        /** @var \Omnipay\Powerboard\Message\Card\AuthenticateWithRedirectResponse $response */
        $response = parent::sendData($data);
        $response->setSdkJsUrl($this->getSdkJsUrl())
                 ->setReturnUrl($this->getReturnUrl());
        return $response;
    }
}
