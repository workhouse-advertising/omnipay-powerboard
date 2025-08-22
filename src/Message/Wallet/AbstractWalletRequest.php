<?php

namespace Omnipay\Powerboard\Message\Wallet;

use Omnipay\Powerboard\Message\AbstractRequest;

abstract class AbstractWalletRequest extends AbstractRequest
{
    /**
     * @return mixed
     */
    public function getGatewayId()
    {
        return $this->getParameter('gatewayId');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setGatewayId($value)
    {
        return $this->setParameter('gatewayId', $value);
    }

    /**
     * @return mixed
     */
    public function getChargeId()
    {
        return $this->getParameter('chargeId');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setChargeId($value)
    {
        return $this->setParameter('chargeId', $value);
    }

    /**
     * @return mixed
     */
    public function getMeta()
    {
        return $this->getParameter('meta');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setMeta($value)
    {
        return $this->setParameter('meta', $value);
    }
}
