<?php

namespace Omnipay\Powerboard\Test\Message\Card;

use Omnipay\Powerboard\Message\Card\PurchaseRequest;
use Omnipay\Powerboard\Test\Message\AbstractMessageTestCase;
use Symfony\Component\HttpFoundation\RedirectResponse as HttpRedirectResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class PurchaseRequestTest extends AbstractMessageTestCase
{
    /**
     * @var \Omnipay\Powerboard\Message\Card\PurchaseRequest
     */
    protected $request;

    /**
     * @inheritDoc
     */
    public function setUp() : void
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new PurchaseRequest($client, $request);

        $this->request->initialize([
            'amount' => 3298.00,
            'currency' => 'AUD',
            'card' => $this->getValidCard(),
            'returnUrl' => 'http://example.com',
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
        ];

        $this->assertEquals($expected, $this->request->getData());
    }

    /**
     * Test the `getData()` method.
     */
    public function testGetDataWith3ds()
    {
        $this->request->setCharge3dsId('ABC123');

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
                'id' => $this->request->getCharge3dsId(),
            ],
        ];

        $this->assertEquals($expected, $this->request->getData());
    }

    /**
     * Test a successful request.
     */
    public function testSendSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $response = $this->request->send();
        $this->assertFalse($response->isPending());
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('68ad29fac2b8434477693452', $response->getTransactionReference());
    }

    /**
     * Test a failed request.
     */
    public function testSendFailure()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');

        $response = $this->request->send();
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('There was an unfulfilled condition so the purchase could not be completed', $response->getMessage());
    }
}
