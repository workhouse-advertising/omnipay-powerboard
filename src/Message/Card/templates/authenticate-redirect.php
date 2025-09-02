<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>3DS Secure</title>
    <script type="text/javascript" src="<?php echo $sdkJsUrl ?? null ?>"></script>
</head>
<body>
    <div id="ThreeDSCanvas" style="height: 100%; height: 100vh;"></div>
    <script>
        <?php
            // TODO: Improve this JS and error handling/messaging.
        ?>
        function handleRedirect(data = {}) {
            var queryParams = Object.keys(data)
                .map(key => `${key}=${encodeURIComponent(data[key])}`)
                .join("&");
            var baseUrl = "<?php echo $redirectUrl ?? null ?>";
            var hasParams = baseUrl.indexOf("?") !== -1;
            var redirectUrl = baseUrl + (hasParams ? "&" : "?") + queryParams;
            window.location.href = redirectUrl;
        }

        try {
            var canvas = new cba.Canvas3ds("#ThreeDSCanvas", "<?php echo $authenticationToken ?? null ?>");
            canvas.load();
            canvas.on("chargeAuthSuccess", function(data) {
                handleRedirect(data);
            });
            canvas.on("chargeAuthReject", function(data) {
                handleRedirect(data);
            });
        } catch (error) {
            alert(error);
            console.error(error);
            handleRedirect();
        }
    </script>
</body>
</html>