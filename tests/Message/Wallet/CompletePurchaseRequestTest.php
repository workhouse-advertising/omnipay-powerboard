<?php

namespace Omnipay\Powerboard\Test\Message\Wallet;

use Omnipay\Powerboard\Message\Wallet\CompletePurchaseRequest as Request;

class CompletePurchaseRequestTest extends PurchaseRequestTest
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
}
