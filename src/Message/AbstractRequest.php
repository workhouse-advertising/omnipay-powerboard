<?php

namespace Omnipay\Powerboard\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\Powerboard\Traits\GatewayParameters;

abstract class AbstractRequest extends BaseAbstractRequest
{
    use GatewayParameters;

    /**
     * Get the endpoint to call.
     *
     * @return string
     */
    abstract public function getEndpoint(): string;

    /**
     * Get the method for the endpoint.
     *
     * @return string
     */
    abstract public function getMethod(): string;

    /**
     * Get the FQCN to use for a response.
     *
     * @return string
     */
    abstract public function getResponseClass(): string;

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
     * Create a response from the response data.
     *
     * @return \Omnipay\Common\Message\AbstractResponse
     */
    protected function makeResponse($responseData): AbstractResponse
    {
        $responseClass = $this->getResponseClass();
        return new $responseClass($this, $responseData);
    }

    /**
     * Get the headers to use for authentication.
     *
     * @return array
     */
    protected function getAuthenticationHeaders(): array
    {
        // NOTE: Prioritising the API key if one is set.
        $header = $this->getApiKey() ? 'x-user-secret-key' : 'x-access-token';
        $value = $this->getApiKey() ?: $this->getAccessToken();

        return [
            $header => $value,
        ];
    }

    /**
     * @inheritDoc
     */
    public function sendData($data)
    {
        $headers = array_merge($this->getAuthenticationHeaders(), [
            'Content-Type' => 'application/json',
        ]);

        $requestBody = ($this->getMethod() == 'GET') ? null : json_encode($data);
        $requestParams = ($this->getMethod() == 'GET') ? '?' . http_build_query($data) : '';

        $httpResponse = $this->httpClient->request($this->getMethod(), $this->getEndpoint() . $requestParams, $headers, $requestBody);
        $responseData = json_decode($httpResponse->getBody(), true);

        // TODO: Confirm the status codes used for failed requests and handle them here if necessary.
        // if (($httpResponse->getStatusCode() < 200 || $httpResponse->getStatusCode() > 299) && $httpResponse->getStatusCode() != 400) {
        //     throw new InvalidRequestException("Invalid request to the Powerboard API. Received status code '{$httpResponse->getStatusCode()}'.");
        // }

        return $this->makeResponse($responseData);
    }
}
