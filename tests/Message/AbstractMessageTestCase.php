<?php

namespace Omnipay\Powerboard\Test\Message;

use Omnipay\Tests\TestCase;

class AbstractMessageTestCase extends TestCase
{
    /**
     * @inheritDoc
     */
    public function getValidCard()
    {
        return [
            'email' => 'test@example.com',
            'firstName' => 'Test',
            'lastName' => 'Tester',
            'number' => '4111111111111111',
            'expiryMonth' => rand(1, 12),
            'expiryYear' => gmdate('Y') + rand(1, 5),
            'cvv' => rand(100, 999),
            'billingAddress1' => '2 Egret St',
            'billingAddress2' => 'Test',
            'billingCity' => 'STIRLING',
            'billingPostcode' => '6021',
            'billingState' => 'WA',
            'billingCountry' => 'AU',
            'billingPhone' => '0412 123 123',
            'shippingAddress1' => '12 Egret St',
            'shippingAddress2' => 'Test',
            'shippingCity' => 'STIRLING',
            'shippingPostcode' => '6021',
            'shippingState' => 'WA',
            'shippingCountry' => 'AU',
            'shippingPhone' => '0412 123 123',
        ];
    }
}
