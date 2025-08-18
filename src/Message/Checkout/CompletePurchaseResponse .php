<?php

namespace Omnipay\Powerboard\Message\Checkout;

use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Powerboard\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        // TODO: Update this so that it works.
        return false;
    }
}
