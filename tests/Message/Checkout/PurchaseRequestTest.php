<?php

namespace Omnipay\Powerboard\Test\Message\Checkout;

use Omnipay\Powerboard\Message\Checkout\PurchaseRequest as Request;
use Omnipay\Powerboard\Test\Message\AbstractMessageTestCase;

class PurchaseRequestTest extends AbstractMessageTestCase
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
            'intentId' => '68be3d2b7871c79eefad13c6',
        ]);
    }

    /**
     * Test the `getData()` method.
     */
    public function testGetData()
    {
        $expected = [];

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
        $this->assertEquals('68be3d2b7871c79eefad13c6', $response->getTransactionReference());
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
        $this->assertSame('There was an error validating your request so the purchase could not be completed', $response->getMessage());
    }
}
