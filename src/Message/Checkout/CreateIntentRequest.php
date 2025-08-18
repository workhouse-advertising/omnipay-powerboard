<?php

namespace Omnipay\Powerboard\Message\Checkout;

use Omnipay\Powerboard\Message\Checkout\AbstractCheckoutRequest;

class CreateIntentRequest extends AbstractCheckoutRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        // TODO: Add other fields for validation.
        $this->validate(
            'amount',
            'currency',
        );

        $data = [
            'customisation' => [
                'template_id' => $this->getCustomisationTemplateId(),
            ],
            'configuration' => [
                'template_id' => $this->getConfigurationTemplateId(),
            ],
            'customer' => [
                'email' => $this->getCard()->getEmail(),
                'phone' => $this->getCard()->getBillingPhone(),
                'billing_address' => [
                    'first_name' => $this->getCard()->getBillingFirstName(),
                    'last_name' => $this->getCard()->getBillingLastName(),
                    'address_line1' => $this->getCard()->getBillingAddress1(),
                    'address_line2' => $this->getCard()->getBillingAddress2(),
                    'address_city' => $this->getCard()->getBillingCity(),
                    'address_state' => $this->getCard()->getBillingState(),
                    'address_country' => $this->getCard()->getBillingCountry(),
                    'address_postcode' => $this->getCard()->getBillingPostcode(),
                ],
            ],
            'amount' => (float) $this->getAmount(),
            'version' => 1, // TODO: Allow this to be configurable.
            'currency' => $this->getCurrency(),
            'reference' => $this->getTransactionId(),
        ];

        if (!$data['customer']['phone']) {
            unset($data['customer']['phone']);
        }
        if (!$data['customer']['billing_address']['address_line2']) {
            unset($data['customer']['billing_address']['address_line2']);
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return sprintf('%s/v1/checkouts/intent', $this->getBaseEndpoint());
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
        return \Omnipay\Powerboard\Message\Checkout\CreateIntentResponse::class;
    }
}
