<?php

namespace Omnipay\Powerboard\Message\Wallet;

use Omnipay\Powerboard\Message\Wallet\AbstractWalletRequest;

class CreateWalletRequest extends AbstractWalletRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'amount',
            'currency',
            'gatewayId',
        );

        $data = [
            'amount' => (float) $this->getAmount(),
            'reference' => $this->getTransactionId(),
            'description' => $this->getDescription(),
            'currency' => $this->getCurrency(),
            'customer' => [
                'email' => $this->getCard()->getEmail(),
                'first_name' => $this->getCard()->getBillingFirstName(),
                'last_name' => $this->getCard()->getBillingLastName(),
                'phone' => $this->getCard()->getBillingPhone(),
                'payment_source' => [
                    'gateway_id' => $this->getGatewayId(),
                    'address_line1' => $this->getCard()->getBillingAddress1(),
                    'address_line2' => $this->getCard()->getBillingAddress2(),
                    'address_city' => $this->getCard()->getBillingCity(),
                    'address_state' => $this->getCard()->getBillingState(),
                    'address_country' => $this->getCard()->getBillingCountry(),
                    'address_postcode' => $this->getCard()->getBillingPostcode(),
                ],
            ],
            'meta' => (array) $this->getMeta(),
        ];

        // Remove any empty values from the customer details and remove description and meta if invalid.
        $data['customer']['payment_source'] = array_filter($data['customer']['payment_source']);
        $data['customer'] = array_filter($data['customer']);
        if (!$data['description']) {
            unset($data['description']);
        }
        if (!$data['meta']) {
            unset($data['meta']);
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return sprintf('%s/v1/charges/wallet', $this->getBaseEndpoint());
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
        return \Omnipay\Powerboard\Message\Wallet\CreateWalletResponse::class;
    }
}
