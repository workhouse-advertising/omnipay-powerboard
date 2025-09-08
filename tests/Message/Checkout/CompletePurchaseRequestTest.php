<?php

namespace Omnipay\Powerboard\Test\Message\Checkout;

use Omnipay\Powerboard\Message\Checkout\CompletePurchaseRequest as Request;

class CompletePurchaseRequestTest extends PurchaseRequestTest
{

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
}
