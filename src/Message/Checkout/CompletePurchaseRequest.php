<?php

namespace Omnipay\Powerboard\Message\Checkout;

use Omnipay\Powerboard\Message\Checkout\PurchaseRequest;

class CompletePurchaseRequest extends PurchaseRequest
{
    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\Powerboard\Message\Checkout\CompletePurchaseResponse::class;
    }
}
