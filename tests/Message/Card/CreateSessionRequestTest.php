<?php

namespace Omnipay\Powerboard\Test\Message\Card;

use Omnipay\Powerboard\Message\Card\CreateSessionRequest;
use Omnipay\Powerboard\Test\Message\AbstractMessageTestCase;

class CreateSessionRequestTest extends AbstractMessageTestCase
{
    /**
     * @var \Omnipay\Powerboard\Message\Card\CreateSessionRequest
     */
    protected $request;

    /**
     * @inheritDoc
     */
    public function setUp() : void
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new CreateSessionRequest($client, $request);
    }

    /**
     * Test the `getData()` method.
     */
    public function testGetData()
    {
        $this->request->setToken('TOKEN1234');

        $expected = [];
        $expected['token'] = 'TOKEN1234';
        $expected['vault_type'] = 'session';

        $this->assertEquals($expected, $this->request->getData());
    }

    /**
     * Test a successful request.
     */
    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CreateSessionSuccess.txt');
        $this->request->setToken('TOKEN1234');

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
        $this->setMockHttpResponse('CreateSessionFailure.txt');
        $this->request->setToken('TOKEN1234');

        $response = $this->request->send();
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('An unspecified error occurred so the purchase could not be completed', $response->getMessage());
    }
}
