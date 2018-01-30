<?php
require_once(__DIR__ . '/../../core/bootstrap.php');

$api = new PrivateAPI();

$http = $api->authentication()
            ->withEmail('user@example.org')
            ->withPassword('password')
            ->submit();

if ($http->succeeds()) {
    var_dump$http->all());
} else {
    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Dang it! Error '{$errorCode}' with message '{$errorMsg}'.";
}
