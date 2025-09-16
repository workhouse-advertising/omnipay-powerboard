<?php

namespace Omnipay\Powerboard\Message;

use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

abstract class AbstractResponse extends BaseAbstractResponse implements RedirectResponseInterface
{
    public const ERROR_UNFULFILLED_CONDITION = 'unfulfilled_condition';
    public const ERROR_UNSPECIFIED_ERROR = 'unspecified_error';
    public const ERROR_VALIDATION_ERROR = 'validation_error';
    public const ERROR_NOT_FOUND = 'not_found';
    public const ERROR_REQUIRED_ERROR = 'required_error';
    public const ERROR_GATEWAY_ERROR = 'gateway_error';
    public const ERROR_INSUFFICIENT_FUNDS = 'insufficient_funds';
    public const ERROR_CREDIT_CARD_INVALID_OR_EXPIRED = 'credit_card_invalid_or_expired';
    public const ERROR_TRANSACTION_DECLINED = 'transaction_declined';
    public const ERROR_TRANSACTION_DECLINED_HARD = 'transaction_declined_hard';
    public const ERROR_SYSTEM_ERROR = 'system_error';
    public const ERROR_FRAUD_WARNING = 'fraud_warning';
    public const ERROR_INVALID_TRANSACTION_DETAILS = 'invalid_transaction_details';
    public const ERROR_INVALID_REQUEST_DETAILS = 'invalid_request_details';
    public const ERROR_INVALID_BANK_ACCOUNT_DETAILS = 'invalid_bank_account_details';
    public const ERROR_INVALID_GATEWAY_CREDENTIALS = 'invalid_gateway_credentials';
    public const ERROR_UNKNOWN = 'unknown';

    /**
     * @var array
     */
    protected static $errorCodeMessages = [
        self::ERROR_UNFULFILLED_CONDITION => 'There was an unfulfilled condition so the purchase could not be completed',
        self::ERROR_UNSPECIFIED_ERROR => 'An unspecified error occurred so the purchase could not be completed',
        self::ERROR_VALIDATION_ERROR => 'There was an error validating your request so the purchase could not be completed',
        self::ERROR_NOT_FOUND => 'A resource could not be found so the purchase could not be completed',
        self::ERROR_REQUIRED_ERROR => 'A required item was not provided so the purchase could not be completed',
        self::ERROR_GATEWAY_ERROR => 'There was a problem with the payment gateway so the purchase could not be completed',
        self::ERROR_INSUFFICIENT_FUNDS => 'There was a problem with the payment source so the purchase could not be completed',
        self::ERROR_CREDIT_CARD_INVALID_OR_EXPIRED => 'There is a problem with the card so the purchase could not be completed',
        self::ERROR_TRANSACTION_DECLINED => 'The transaction did not proceed so the purchase could not be completed',
        self::ERROR_TRANSACTION_DECLINED_HARD => 'There was a problem with the transaction so the purchase could not be completed',
        self::ERROR_SYSTEM_ERROR => 'There was a problem with the payment system so the purchase could not be completed',
        self::ERROR_FRAUD_WARNING => 'The attempt was flagged with a problem so the purchase could not be completed',
        self::ERROR_INVALID_TRANSACTION_DETAILS => 'The transaction is invlalid so the purchase could not be completed',
        self::ERROR_INVALID_REQUEST_DETAILS => 'The request is invlalid so the purchase could not be completed',
        self::ERROR_INVALID_BANK_ACCOUNT_DETAILS => 'The details are invlalid so the purchase could not be completed',
        self::ERROR_INVALID_GATEWAY_CREDENTIALS => 'The payment gateway had a problem so the purchase could not be completed',
        self::ERROR_UNKNOWN => 'An unknown error occurred so the purchase could not be completed',
    ];

    public static function setErrorMessages(array $mappedErrorMessages)
    {
        self::$errorCodeMessages = array_merge(self::$errorCodeMessages, $mappedErrorMessages);
    }

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
        return $errorCode ? (self::$errorCodeMessages[$errorCode] ?? null) : null;
    }
}
