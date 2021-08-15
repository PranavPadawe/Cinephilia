<?php
require_once("PayPal-PHP-SDK/autoload.php");

$apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AfwyHIc1zyccFSzCUmwkyajb6YnXCjNRuBxZ9LNL2wsKIWbzZ2u_7KQ8z3JNNP-hkH1c0ayLSr_LEaab',     // ClientID
            'EHHlrGQk0FjWIDPH5HHitqjSqGyi_5nfVQDnsTqNqEDJNAOCAEEw_a92B_RJG6ntTfMoC9cuIVMhLQaN'      // ClientSecret
        )
);
 ?>
