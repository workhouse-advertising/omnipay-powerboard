<?php

namespace Omnipay\Powerboard\Message\Card;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Powerboard\Message\Card\AbstractCardRequest;

class AuthenticateRequest extends AbstractCardRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'amount',
            'currency',
            'vaultToken',
            // TODO: Consider if `gatewayId` should also be required.
            //       Apparently rules can be set up to handle this automatically, so maybe not.
        );

        $data = [
            'amount' => (float) $this->getAmount(),
            'currency' => $this->getCurrency(),
            'reference' => $this->getTransactionId(),
            'customer' => [
                'first_name' => $this->getCard()->getBillingFirstName(),
                'last_name' => $this->getCard()->getBillingLastName(),
                'phone' => $this->getCard()->getBillingPhone(),
                'email' => $this->getCard()->getEmail(),
                'payment_source' => [
                    'vault_token' => $this->getVaultToken(),
                    'gateway_id' => $this->getGatewayId(),
                    'address_line1' => $this->getCard()->getBillingAddress1(),
                    'address_line2' => $this->getCard()->getBillingAddress2(),
                    'address_city' => $this->getCard()->getBillingCity(),
                    'address_state' => $this->getCard()->getBillingState(),
                    'address_country' => $this->getCard()->getBillingCountry(),
                    'address_postcode' => $this->getCard()->getBillingPostcode(),
                ],
            ],
            '_3ds' => [
                'browser_details' => (array) $this->getBrowserDetails(),
            ],
        ];

        // Remove any empty values from the customer details.
        $data['customer']['payment_source'] = array_filter($data['customer']['payment_source']);
        $data['customer'] = array_filter($data['customer']);

        return $data;
    }

    /**
     * @return mixed
     */
    public function getBrowserDetails()
    {
        return $this->getParameter('browserDetails');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setBrowserDetails($value)
    {
        return $this->setParameter('browserDetails', $value);
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return sprintf('%s/v1/charges/3ds', $this->getBaseEndpoint());
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return 'POST';
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\Powerboard\Message\Card\AuthenticateResponse::class;
    }
}
