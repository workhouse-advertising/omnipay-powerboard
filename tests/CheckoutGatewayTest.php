<?php

namespace Omnipay\Powerboard\Test;

use Omnipay\Powerboard\CheckoutGateway;
use Omnipay\Tests\GatewayTestCase;

class CheckoutGatewayTest extends GatewayTestCase
{
    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new CheckoutGateway($this->getHttpClient(), $this->getHttpRequest());
    }
}
