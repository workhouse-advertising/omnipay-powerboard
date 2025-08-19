<?php

namespace Omnipay\Powerboard\Message\Card;

use Omnipay\Powerboard\Message\AbstractResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AuthenticateResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        return true;
    }

    /**
     * @return mixed
     */
    public function getAuthenticationToken()
    {
        return $this->getData()['authenticationToken'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getSdkJsUrl()
    {
        return $this->getData()['sdkJsUrl'] ?? null;
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
    public function getRedirectHtml()
    {
        return '<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>3DS Secure</title>
    <script type="text/javascript" src="' . $this->getSdkJsUrl() . '"></script>
</head>
<body>
    <div id="ThreeDSCanvas" style="height: 100%; height: 100vh;"></div>
    <script>
        var canvas = new cba.Canvas3ds("#ThreeDSCanvas", "' . $this->getAuthenticationToken() . '");        
        canvas.load();
        canvas.on("chargeAuthSuccess", function(data) {
            console.log(data);
        });
        canvas.on("chargeAuthReject", function(data) {
            console.log(data);
        });
    </script>
</body>
</html>';
    }

    /**
     * @return HttpResponse
     */
    public function getRedirectResponse()
    {
        // $this->validateRedirect();
        return new HttpResponse($this->getRedirectHtml());
    }
}
