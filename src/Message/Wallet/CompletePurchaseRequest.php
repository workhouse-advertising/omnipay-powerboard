<?php

namespace Omnipay\Powerboard\Message\Wallet;

use Omnipay\Powerboard\Message\Wallet\PurchaseRequest;

class CompletePurchaseRequest extends PurchaseRequest
{
    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\Powerboard\Message\Wallet\CompletePurchaseResponse::class;
    }
}
