<?php

require_once(__DIR__ . '/../core/AddPayOpenAPI.php');

$call = $api->transactions()
            ->find('TRANSACTION_ID_HERE');

if ($call->succeeds()) {

    // Read the documentation on what to do next.
    print_r($call->resource);

} else {
    $errorCode = $call->getErrorCode();
    $errorMsg  = $call->getErrorMessage();

    echo "Dang it! Error '{$errorCode}' with message '{$errorMsg}'.";
}
