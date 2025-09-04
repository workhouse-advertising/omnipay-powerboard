<?php

namespace Omnipay\Powerboard\Test\Message\Card;

use Omnipay\Powerboard\Message\Card\AuthenticateRequest;
use Omnipay\Powerboard\Test\Message\AbstractMessageTestCase;

class AuthenticateRequestTest extends AbstractMessageTestCase
{
    /**
     * @var \Omnipay\Powerboard\Message\Card\AuthenticateRequest
     */
    protected $request;

    /**
     * @inheritDoc
     */
    public function setUp() : void
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new AuthenticateRequest($client, $request);

        $this->request->initialize([
            'amount' => 3298.00,
            'currency' => 'AUD',
            'card' => $this->getValidCard(),
        ]);
        $this->request->setVaultToken('e5683fc1-3bbf-4859-8677-3475e64d1467');
        $this->request->setGatewayId('ABC123');
    }

    /**
     * Test the `getData()` method.
     */
    public function testGetData()
    {
        $expected = [
            'amount' => (float) $this->request->getAmount(),
            'currency' => $this->request->getCurrency(),
            'reference' => $this->request->getTransactionId(),
            'customer' => [
                'first_name' => $this->request->getCard()->getBillingFirstName(),
                'last_name' => $this->request->getCard()->getBillingLastName(),
                'phone' => $this->request->getCard()->getBillingPhone(),
                'email' => $this->request->getCard()->getEmail(),
                'payment_source' => [
                    'vault_token' => $this->request->getVaultToken(),
                    'gateway_id' => $this->request->getGatewayId(),
                    'address_line1' => $this->request->getCard()->getBillingAddress1(),
                    'address_line2' => $this->request->getCard()->getBillingAddress2(),
                    'address_city' => $this->request->getCard()->getBillingCity(),
                    'address_state' => $this->request->getCard()->getBillingState(),
                    'address_country' => $this->request->getCard()->getBillingCountry(),
                    'address_postcode' => $this->request->getCard()->getBillingPostcode(),
                ],
            ],
            '_3ds' => [
                'browser_details' => $this->request->getBrowserDetails() ?? [],
            ],
        ];

        $this->assertEquals($expected, $this->request->getData());
    }

    /**
     * Test a successful request.
     */
    public function testSendSuccess()
    {
        $this->setMockHttpResponse('AuthenticateSuccess.txt');

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
        $this->setMockHttpResponse('AuthenticateFailure.txt');

        $response = $this->request->send();
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('There was an error validating your request so the purchase could not be completed', $response->getMessage());
    }
}
