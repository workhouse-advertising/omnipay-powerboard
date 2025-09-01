<?php

namespace Omnipay\Powerboard\Message;

use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

abstract class AbstractResponse extends BaseAbstractResponse implements RedirectResponseInterface
{
    /**
     * @var array
     */
    protected $errorCodeMessages = [
        'unfulfilled_condition' => 'There was an unfulfilled condition so the payment could not be completed',
        'unspecified_error' => 'An unspecified error occurred so the payment could not be completed',
        'validation_error' => 'There was an error validating your request so the payment could not be completed',
        'not_found' => 'A resource could not be found so the payment could not be completed',
        'required_error' => 'A required item was not provided so the payment could not be completed',
        'gateway_error' => 'There was a problem with the payment gateway so the payment could not be completed',
        'insufficient_funds' => 'There was a problem with the payment source so the payment could not be completed',
        'credit_card_invalid_or_expired' => 'There is a problem with the card so the payment could not be completed',
        'transaction_declined' => 'The transaction did not proceed so the payment could not be completed',
        'transaction_declined_hard' => 'There was a problem with the transaction so the payment could not be completed',
        'system_error' => 'There was a problem with the payment system so the payment could not be completed',
        'fraud_warning' => 'The attempt was flagged with a problem so the payment could not be completed',
        'invalid_transaction_details' => 'The transaction is invlalid so the payment could not be completed',
        'invalid_request_details' => 'The request is invlalid so the payment could not be completed',
        'invalid_bank_account_details' => 'The details are invlalid so the payment could not be completed',
        'invalid_gateway_credentials' => 'The payment gateway had a problem so the payment could not be completed',
        'unknown' => 'An unknown error occurred so the payment could not be completed',
    ];

    /**
     * @return mixed
     */
    public function getErrorSummary()
    {
        return $this->getData()['error_summary'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getErrorCode()
    {
        return $this->getErrorSummary()['code'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getMessage()
    {
        $errorCode = $this->getErrorCode();
        return $errorCode ? ($this->errorCodeMessages[$errorCode] ?? null) : null;
    }
}
