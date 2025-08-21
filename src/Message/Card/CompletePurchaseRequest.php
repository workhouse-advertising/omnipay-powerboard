<?php

namespace Omnipay\Powerboard\Message\Card;

use Omnipay\Powerboard\Message\Card\PurchaseRequest;

class CompletePurchaseRequest extends PurchaseRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        $data = parent::getData();

        if ($this->get3dsRequired()) {
            $this->validate('charge3dsId');
        }

        if ($this->getCharge3dsId()) {
            $data['_3ds']['id'] = $this->getCharge3dsId();
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\Powerboard\Message\Card\CompletePurchaseResponse::class;
    }

    /**
     * @return mixed
     */
    public function get3dsRequired()
    {
        return $this->getParameter('3dsRequired');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function set3dsRequired($value)
    {
        return $this->setParameter('3dsRequired', $value);
    }

    /**
     * @return mixed
     */
    public function getCharge3dsId()
    {
        return $this->getParameter('charge3dsId');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setCharge3dsId($value)
    {
        return $this->setParameter('charge3dsId', $value);
    }
}
