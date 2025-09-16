<?php

namespace Omnipay\Powerboard\Traits;

trait GatewayParameters
{
    /**
     * @return string
     */
    public function getBaseAssetUrl()
    {
        return $this->getTestMode() ? $this->getTestBaseAssetUrl() : $this->getLiveBaseAssetUrl();
    }

    /**
     * @return string
     */
    public function getLiveBaseAssetUrl()
    {
        return 'https://widget.powerboard.commbank.com.au';
    }

    /**
     * @return string
     */
    public function getTestBaseAssetUrl()
    {
        return 'https://widget.preproduction.powerboard.commbank.com.au';
    }

    /**
     * @return string
     */
    public function getSdkJsUrl()
    {
        return sprintf('%s/sdk/latest/widget.umd.js', $this->getBaseAssetUrl());
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

    /**
     * @return mixed
     */
    public function getCustomisationTemplateId()
    {
        return $this->getParameter('customisationTemplateId');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setCustomisationTemplateId($value)
    {
        return $this->setParameter('customisationTemplateId', $value);
    }

    /**
     * @return mixed
     */
    public function getConfigurationTemplateId()
    {
        return $this->getParameter('configurationTemplateId');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setConfigurationTemplateId($value)
    {
        return $this->setParameter('configurationTemplateId', $value);
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->getParameter('version');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setVersion($value)
    {
        return $this->setParameter('version', $value);
    }
}
