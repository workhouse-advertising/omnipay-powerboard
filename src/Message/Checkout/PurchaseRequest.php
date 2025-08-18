<?php

namespace Omnipay\Powerboard\Message\Checkout;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Powerboard\Message\Checkout\AbstractCheckoutRequest;
use Omnipay\Powerboard\Message\Checkout\PurchaseResponse;

class PurchaseRequest extends AbstractCheckoutRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'amount',
            'currency',
            'intentId',
        );

        return [];
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        // TODO: Update this so that it works.
        return sprintf('%s/v1/checkouts/intent/%s', $this->getBaseEndpoint(), $this->getIntentId());
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
        return \Omnipay\Powerboard\Message\Checkout\PurchaseResponse::class;
    }
}
