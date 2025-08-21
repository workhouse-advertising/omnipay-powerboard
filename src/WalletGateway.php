<?php

namespace Omnipay\Powerboard;

use Omnipay\Powerboard\AbstractGateway;

class WalletGateway extends AbstractGateway
{
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'Powerboard wallet payments';
    }

    /**
     * Create a wallet charge.
     *
     * @param array $options
     * @return \Omnipay\Powerboard\Message\Wallet\CreateWalletRequest
     */
    public function createWallet(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\Powerboard\Message\Wallet\CreateWalletRequest::class, $options);
        /** @var \Omnipay\Powerboard\Message\Wallet\CreateWalletRequest $request */
        return $request;
    }

    /**
     * Get a wallet charge.
     *
     * @param array $options
     * @return \Omnipay\Powerboard\Message\Wallet\GetWalletRequest
     */
    public function getWallet(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\Powerboard\Message\Wallet\GetWalletRequest::class, $options);
        /** @var \Omnipay\Powerboard\Message\Wallet\GetWalletRequest $request */
        return $request;
    }

    /**
     * Authorize and immediately capture an amount on the customers card
     *
     * @param array $options
     * @return \Omnipay\Powerboard\Message\Wallet\PurchaseRequest
     */
    public function purchase(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\Powerboard\Message\Wallet\PurchaseRequest::class, $options);
        /** @var \Omnipay\Powerboard\Message\Wallet\PurchaseRequest $request */
        return $request;
    }

    /**
     * Handle return from off-site gateways after purchase
     *
     * @param array $options
     * @return \Omnipay\Powerboard\Message\Wallet\CompletePurchaseRequest
     */
    public function completePurchase(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\Powerboard\Message\Wallet\CompletePurchaseRequest::class, $options);
        /** @var \Omnipay\Powerboard\Message\Wallet\CompletePurchaseRequest $request */
        return $request;
    }
}
