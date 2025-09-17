<?php

namespace Omnipay\Powerboard\Test\Message\Wallet;

use Omnipay\Powerboard\Message\Wallet\CreateWalletRequest as Request;
use Omnipay\Powerboard\Test\Message\AbstractMessageTestCase;

class CreateWalletRequestTest extends AbstractMessageTestCase
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

        $this->request->setDescription('a description');
        $this->request->setGatewayId('a gateway ID');
    }

    /**
     * Test the `getData()` method.
     */
    public function testGetData()
    {
        $expected = [
            'amount' => (float) $this->request->getAmount(),
            'reference' => $this->request->getTransactionId(),
            'description' => $this->request->getDescription(),
            'currency' => $this->request->getCurrency(),
            'customer' => [
                'email' => $this->request->getCard()->getEmail(),
                'first_name' => $this->request->getCard()->getBillingFirstName(),
                'last_name' => $this->request->getCard()->getBillingLastName(),
                'phone' => $this->request->getCard()->getBillingPhone(),
                'payment_source' => [
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
     * Test a successful request.
     */
    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CreateWalletSuccess.txt');

        $response = $this->request->send();
        $this->assertFalse($response->isPending());
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('68b00b9d22423a77c1576739', $response->getTransactionReference());
    }

    /**
     * Test a failed request.
     */
    public function testSendFailure()
    {
        $this->setMockHttpResponse('CreateWalletFailure.txt');

        $response = $this->request->send();
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('There was an error validating your request so the purchase could not be completed', $response->getMessage());
    }
}
