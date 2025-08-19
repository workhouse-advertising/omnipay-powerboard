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
        ];
    }

    /**
     * @return string
     */
    public function getSdkJsUrl()
    {
        // TODO: Update this to use a specific versioned version of the JS.
        return sprintf('%s/sdk/latest/widget.umd.js', $this->getBaseAssetUrl());
    }
}
