<?php

namespace Omnipay\Powerboard\Message\Wallet;

use Omnipay\Powerboard\Message\AbstractResponse;

class CreateWalletResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        return ($this->getData()['status'] ?? null) == 201;
    }

    /**
     * @return mixed
     */
    public function getResource()
    {
        return $this->getData()['resource']['data'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getWallet()
    {
        return $this->getResource();
    }

    /**
     * @return mixed
     */
    public function getCharge()
    {
        return $this->getResource()['charge'] ?? null;
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
    public function getWalletToken()
    {
        return $this->getResource()['token'] ?? null;
    }
}
