<?php

namespace Omnipay\Powerboard\Test\Message\Wallet;

use Omnipay\Powerboard\Message\Wallet\GetWalletRequest as Request;
use Omnipay\Powerboard\Test\Message\AbstractMessageTestCase;

class GetWalletRequestTest extends AbstractMessageTestCase
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

        $this->request->setChargeId('68b7e84a22423a77c15927c2');
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
        $this->setMockHttpResponse('GetWalletSuccess.txt');

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
        $this->setMockHttpResponse('GetWalletFailure.txt');

        $response = $this->request->send();
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('A resource could not be found so the purchase could not be completed', $response->getMessage());
    }
}
