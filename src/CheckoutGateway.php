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
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function createIntent(array $options = [])
    {
        return $this->createRequest(\Omnipay\Powerboard\Message\Checkout\CreateIntentRequest::class, $options);
    }

    /**
     * Get a checkout intent.
     *
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function getIntent(array $options = [])
    {
        return $this->createRequest(\Omnipay\Powerboard\Message\Checkout\GetIntentRequest::class, $options);
    }

    /**
     * Authorize and immediately capture an amount on the customers card
     *
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function purchase(array $options = [])
    {
        return $this->createRequest(\Omnipay\Powerboard\Message\Checkout\PurchaseRequest::class, $options);
    }

    /**
     * Handle return from off-site gateways after purchase
     *
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function completePurchase(array $options = [])
    {
        return $this->createRequest(\Omnipay\Powerboard\Message\Checkout\CompletePurchaseRequest::class, $options);
    }
}
