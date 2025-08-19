<?php

namespace Omnipay\Powerboard\Message\Card;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Powerboard\Message\Card\AbstractCardRequest;

class CreateSessionRequest extends AbstractCardRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'token',
        );

        return [
            'token' => $this->getToken(),
            'vault_type' => 'session',
        ];
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return sprintf('%s/v1/vault/payment_sources', $this->getBaseEndpoint());
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return 'POST';
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\Powerboard\Message\Card\CreateSessionResponse::class;
    }
}
