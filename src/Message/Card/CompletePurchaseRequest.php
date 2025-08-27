<?php

namespace Omnipay\Powerboard\Message\Card;

use Omnipay\Powerboard\Message\Card\PurchaseRequest;

class CompletePurchaseRequest extends PurchaseRequest
{
    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\Powerboard\Message\Card\CompletePurchaseResponse::class;
    }
}
