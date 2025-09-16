<?php

namespace Omnipay\Powerboard\Test\Message\Checkout;

use Omnipay\Powerboard\Message\Checkout\CreateIntentRequest as Request;
use Omnipay\Powerboard\Test\Message\AbstractMessageTestCase;

class CreateIntentRequestTest extends AbstractMessageTestCase
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @inheritDoc
     */
    public function setUp() : void
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new Request($client, $request);

        $this->request->initialize([
            'amount' => 3298.00,
            'currency' => 'AUD',
            'card' => $this->getValidCard(),
        ]);

        $this->request->setCustomisationTemplateId('a customisation template id');
        $this->request->setConfigurationTemplateId('a configuration template id');
        $this->request->setVersion(123);
    }

    /**
     * Test the `getData()` method.
     */
    public function testGetData()
    {
        $expected = [
            'customisation' => [
                'template_id' => $this->request->getCustomisationTemplateId(),
            ],
            'configuration' => [
                'template_id' => $this->request->getConfigurationTemplateId(),
            ],
            'customer' => [
                'email' => $this->request->getCard()->getEmail(),
                'phone' => $this->request->getCard()->getBillingPhone(),
                'billing_address' => [
                    'first_name' => $this->request->getCard()->getBillingFirstName(),
                    'last_name' => $this->request->getCard()->getBillingLastName(),
                    'address_line1' => $this->request->getCard()->getBillingAddress1(),
                    'address_line2' => $this->request->getCard()->getBillingAddress2(),
                    'address_city' => $this->request->getCard()->getBillingCity(),
                    'address_state' => $this->request->getCard()->getBillingState(),
                    'address_country' => $this->request->getCard()->getBillingCountry(),
                    'address_postcode' => $this->request->getCard()->getBillingPostcode(),
                ],
            ],
            'amount' => (float) $this->request->getAmount(),
            'version' => 123,
            'currency' => $this->request->getCurrency(),
            'reference' => $this->request->getTransactionId(),
        ];

        $this->assertEquals($expected, $this->request->getData());
    }

    /**
     * Test a successful request.
     */
    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CreateIntentSuccess.txt');

        $response = $this->request->send();
        $this->assertFalse($response->isPending());
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
    }

    /**
     * Test a failed request.
     */
    public function testSendFailure()
    {
        $this->setMockHttpResponse('CreateIntentFailure.txt');

        $response = $this->request->send();
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('There was an error validating your request so the purchase could not be completed', $response->getMessage());
    }
}
