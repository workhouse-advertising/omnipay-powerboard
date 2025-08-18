<?php

namespace Omnipay\Powerboard;

use Omnipay\Powerboard\AbstractGateway;

class CheckoutGateway extends AbstractGateway
{
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'Powerboard checkout';
    }

    /**
     * Create a checkout intent.
     *
     * @param array $options
     * @return \Omnipay\Powerboard\Message\Checkout\CreateIntentRequest
     */
    public function createIntent(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\Powerboard\Message\Checkout\CreateIntentRequest::class, $options);
        /** @var \Omnipay\Powerboard\Message\Checkout\CreateIntentRequest $request */
        return $request;
    }

    /**
     * Get a checkout intent.
     *
     * @param array $options
     * @return \Omnipay\Powerboard\Message\Checkout\GetIntentRequest
     */
    public function getIntent(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\Powerboard\Message\Checkout\GetIntentRequest::class, $options);
        /** @var \Omnipay\Powerboard\Message\Checkout\GetIntentRequest $request */
        return $request;
    }

    /**
     * Authorize and immediately capture an amount on the customers card
     *
     * @param array $options
     * @return \Omnipay\Powerboard\Message\Checkout\PurchaseRequest
     */
    public function purchase(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\Powerboard\Message\Checkout\PurchaseRequest::class, $options);
        /** @var \Omnipay\Powerboard\Message\Checkout\PurchaseRequest $request */
        return $request;
    }

    /**
     * Handle return from off-site gateways after purchase
     *
     * @param array $options
     * @return \Omnipay\Powerboard\Message\Checkout\CompletePurchaseRequest
     */
    public function completePurchase(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\Powerboard\Message\Checkout\CompletePurchaseRequest::class, $options);
        /** @var \Omnipay\Powerboard\Message\Checkout\CompletePurchaseRequest $request */
        return $request;
    }
}
