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
        // TODO: Map all expected error codes to a user friendly string that does not
        //       expose the actual error reason.
        'unfulfilled_condition' => 'There was an error processing the payment due to an unfulfilled condition',
        'unspecified_error' => 'An unspecified error occurred',
        'validation_error' => 'There was an error validating your request',
        'not_found' => 'The payment could not be processed because a resource could not be found',
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
