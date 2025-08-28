<?php

namespace Omnipay\Powerboard\Test\Message\Wallet;

use Omnipay\Powerboard\Message\Wallet\PurchaseRequest as Request;
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
            'chargeId' => 'a charge ID',
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
        $this->assertSame('The payment could not be processed because a resource could not be found', $response->getMessage());
    }
}
