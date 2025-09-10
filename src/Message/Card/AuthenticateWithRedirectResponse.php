<?php

namespace Omnipay\Powerboard\Message\Card;

use Omnipay\Powerboard\Message\Card\AuthenticateResponse;
use Symfony\Component\HttpFoundation\RedirectResponse as HttpRedirectResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AuthenticateWithRedirectResponse extends AuthenticateResponse
{
    protected string $threeDsUrl;

    /**
     * @param mixed $value
     * @return $this
     */
    public function setSdkJsUrl($value)
    {
        $this->data['sdkJsUrl'] = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSdkJsUrl()
    {
        return $this->getData()['sdkJsUrl'] ?? null;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function set3dsUrl($value)
    {
        $this->threeDsUrl = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function get3dsUrl()
    {
        return $this->threeDsUrl;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setReturnUrl($value)
    {
        $this->data['returnUrl'] = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReturnUrl()
    {
        return $this->getData()['returnUrl'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function isTransparentRedirect()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getRedirectUrl()
    {
        return $this->get3dsUrl() . '?' . http_build_query([
            'sdkJsUrl' => $this->getSdkJsUrl(),
            'authenticationToken' => $this->getAuthenticationToken(),
            'redirectUrl' => $this->getReturnUrl(),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getRedirectHtml()
    {
        $sdkJsUrl = $this->getSdkJsUrl();
        $authenticationToken = $this->getAuthenticationToken();
        $redirectUrl = $this->getRedirectUrl();

        ob_start();
        // TODO: Add JS error handling to this template.
        include(__DIR__ . '/templates/authenticate-redirect.php');
        return ob_get_clean();
    }

    /**
     * @inheritDoc
     */
    public function getRedirectResponse()
    {
        // $this->validateRedirect();
        return new HttpRedirectResponse($this->getRedirectUrl());
        // return $this->isSuccessful() ? new HttpResponse($this->getRedirectHtml()) : new HttpRedirectResponse($this->getRedirectUrl());
    }
}
