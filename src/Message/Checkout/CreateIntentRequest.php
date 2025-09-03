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
        $this->validate(
            'amount',
            'currency',
            'version',
            'customisationTemplateId',
            'configurationTemplateId',
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
            'version' => (int) $this->getVersion(),
            'currency' => $this->getCurrency(),
            'reference' => $this->getTransactionId(),
        ];

        // Remove any empty values from the customer details.
        $data['customer']['billing_address'] = array_filter($data['customer']['billing_address']);
        $data['customer'] = array_filter($data['customer']);

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
