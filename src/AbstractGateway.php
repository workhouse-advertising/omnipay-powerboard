<?php

namespace Omnipay\Powerboard;

use Omnipay\Common\AbstractGateway as AbstractGatewayBase;
use Omnipay\Powerboard\Traits\GatewayParameters;

abstract class AbstractGateway extends AbstractGatewayBase
{
    use GatewayParameters;

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            // NOTE: Either an API key or an access token can be provided.
            'apiKey' => null,
            'accessToken' => null,
            'testMode' => false,
            'customisationTemplateId' => null,
            'configurationTemplateId' => null,
            'version' => 1,
        ];
    }

    /**
     * Get a charge.
     *
     * @param array $options
     * @return \Omnipay\Powerboard\Message\GetChargeRequest
     */
    public function getCharge(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\Powerboard\Message\GetChargeRequest::class, $options);
        /** @var \Omnipay\Powerboard\Message\GetChargeRequest $request */
        return $request;
    }
}
