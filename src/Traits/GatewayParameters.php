<?php

namespace Omnipay\Powerboard\Traits;

trait GatewayParameters
{
    /**
     * @return string
     */
    public function getBaseAssetUrl()
    {
        return $this->getBaseEndpoint();
    }

    /**
     * @return string
     */
    public function getBaseEndpoint()
    {
        return $this->getTestMode() ? $this->getTestBaseEndpoint() : $this->getLiveBaseEndpoint();
    }

    /**
     * @return string
     */
    public function getLiveBaseEndpoint()
    {
        return 'https://api.powerboard.commbank.com.au';
    }

    /**
     * @return string
     */
    public function getTestBaseEndpoint()
    {
        return 'https://api.preproduction.powerboard.commbank.com.au';
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->getParameter('accessToken');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setAccessToken($value)
    {
        return $this->setParameter('accessToken', $value);
    }
}
