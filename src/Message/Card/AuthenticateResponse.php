<?php

namespace Omnipay\Powerboard\Message\Card;

use Omnipay\Powerboard\Message\AbstractResponse;

class AuthenticateResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        // TODO: Should this be considering more than 201. Maybe consider $this->getChargeStatus() == 'authenticated', we currently ignore 'pre_authentication_pending' and maybe we shouldn't
        return ($this->getData()['status'] ?? null) == 201;
    }

    /**
     * @return array
     */
    public function getAuthenticationResponse()
    {
        return (array) ($this->getCharge()['_3ds'] ?? []);
    }

    /**
     * @return mixed
     */
    public function getCharge()
    {
        return $this->getData()['resource']['data'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getChargeStatus()
    {
        return $this->getCharge()['status'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getAuthenticationToken()
    {
        return $this->getAuthenticationResponse()['token'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getAuthenticationResult()
    {
        return $this->getAuthenticationResponse()['gateway_result'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getAuthenticationStatus()
    {
        return $this->getAuthenticationResponse()['gateway_status'] ?? null;
    }

    /**
     * @return bool
     */
    public function isAuthenticationNotAvailable()
    {
        return $this->getChargeStatus() == 'authentication_not_supported';
    }

    /**
     * @return bool
     */
    public function authenticationFailed()
    {
        return $this->getAuthenticationResult() === 'FAILURE';
    }

    /**
     * @return bool
     */
    public function shouldProceed()
    {
        // TODO: Is this useful or required any more? Or only relevant for the MPGS portal?
        return (bool) $this->isSuccessful();
    }
}
