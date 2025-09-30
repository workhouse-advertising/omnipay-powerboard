<?php

namespace Omnipay\Powerboard;

use Omnipay\Powerboard\AbstractGateway;

class CardGateway extends AbstractGateway
{
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'Powerboard card payment';
    }

    /**
     * Create a charge session.
     *
     * @param array $options
     * @return \Omnipay\Powerboard\Message\Card\CreateSessionRequest
     */
    public function createSession(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\Powerboard\Message\Card\CreateSessionRequest::class, $options);
        /** @var \Omnipay\Powerboard\Message\Card\CreateSessionRequest $request */
        return $request;
    }

    /**
     * Handle 3DS authentication.
     *
     * @param array $options
     * @return \Omnipay\Powerboard\Message\Card\AuthenticateRequest
     */
    public function authenticate(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\Powerboard\Message\Card\AuthenticateRequest::class, $options);
        /** @var \Omnipay\Powerboard\Message\Card\AuthenticateRequest $request */
        return $request;
    }

    /**
     * Handle 3DS authentication with a transparent redirect.
     *
     * @param array $options
     * @return \Omnipay\Powerboard\Message\Card\AuthenticateWithRedirectRequest
     */
    public function authenticateWithRedirect(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\Powerboard\Message\Card\AuthenticateWithRedirectRequest::class, $options);
        /** @var \Omnipay\Powerboard\Message\Card\AuthenticateWithRedirectRequest $request */
        return $request;
    }

    /**
     * Authorize and immediately capture an amount on the customers card
     *
     * @param array $options
     * @return \Omnipay\Powerboard\Message\Card\PurchaseRequest
     */
    public function purchase(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\Powerboard\Message\Card\PurchaseRequest::class, $options);
        /** @var \Omnipay\Powerboard\Message\Card\PurchaseRequest $request */
        return $request;
    }

    /**
     * Handle return from off-site gateways after purchase
     *
     * @param array $options
     * @return \Omnipay\Powerboard\Message\Card\CompletePurchaseRequest
     */
    public function completePurchase(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\Powerboard\Message\Card\CompletePurchaseRequest::class, $options);
        /** @var \Omnipay\Powerboard\Message\Card\CompletePurchaseRequest $request */
        return $request;
    }
}
