<?php

namespace Omnipay\Powerboard\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Powerboard\Message\AbstractRequest;
use Omnipay\Powerboard\Message\GetChargeResponse;

class GetChargeRequest extends AbstractRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'chargeId',
        );

        return [];
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return sprintf('%s/v1/charges/%s', $this->getBaseEndpoint(), $this->getChargeId());
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return 'GET';
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\Powerboard\Message\GetChargeResponse::class;
    }
}
