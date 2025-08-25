<?php

namespace Omnipay\Powerboard\Test;

use Omnipay\Powerboard\WalletGateway;
use Omnipay\Tests\GatewayTestCase;

class WalletGatewayTest extends GatewayTestCase
{
    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new WalletGateway($this->getHttpClient(), $this->getHttpRequest());
    }
}
