<?php

require 'includes/paypal/autoload.php';

define('URL_SITIO', 'http://localhost/GDLWebcam');

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        //Cliente ID
        'Ad2g67vkXCn1CWte3fZuknaEfZ78D0p2D_omd2pTMK6vKCMBg3H9UKuwgzZP9TpeCy0ED0P7eAVLJP9b',
        //Secret ID
        'EGqeoU6Lu0ZLk9YW3DtDHj8V48kggaYKjxWDZoV-_uQLsrt1MN7VLpZBN9eMPdrTS1KDvk5pxC4WPTds'
    )
);

