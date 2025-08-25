<?php

namespace Omnipay\Powerboard\Test;

use Omnipay\Powerboard\CardGateway;
use Omnipay\Tests\GatewayTestCase;

class CardGatewayTest extends GatewayTestCase
{
    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new CardGateway($this->getHttpClient(), $this->getHttpRequest());
    }
}
