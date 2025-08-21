<?php

namespace Omnipay\Powerboard\Message\Wallet;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Powerboard\Message\Wallet\AbstractWalletRequest;
use Omnipay\Powerboard\Message\Wallet\PurchaseResponse;

class PurchaseRequest extends AbstractWalletRequest
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
        return \Omnipay\Powerboard\Message\Wallet\PurchaseResponse::class;
    }
}
