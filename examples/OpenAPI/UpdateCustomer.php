<?php
$result = openApi()
          ->transactions()
          ->withId('id')
          ->withCustomerFirstname('Gengis')
          ->withCustomerLastname('Khan')
          ->withCustomerEmail('gengiskhan@example.org')
          ->withCustomerMobile('8212345678')
          ->update();

if ($result->fails()) {

    /*
    | -------------------------------------------
    | USE THE ERROR CODE AND MESSAGE FOR LOGGING
    | -------------------------------------------
    | With the code and message, it's sinch to debug.
    */
    $errorCode = $result->getErrorCode();
    $errorMsg  = $result->getErrorMessage();
    $errorLDT  = date('Ymd');

    // Let's just save the result to file for now
    file_put_contents("logs_{$errorLDT}.log", "Received error code '{$errorCode}' with error message '{$errorMessage}'.", FILE_APPEND);

    return;
} elseif ($result->succeeds()) {

    /*
    | --------------------------------------------------------------
    | VAR_DUMP IS REALLY JUST TO SHOW YOU WHAT FIELDS ARE AVAILABLE
    | TO BE CALLED UNDER THE MAGIC METHODS. IE, IF DESCRIPTION IS
    | PRESENT IN THE VAR_DUMP, WE CAN CALL $result->getDescription().
    | --------------------------------------------------------------
    | Please avoid using var_dump in production environments. It'd
    | be highly preferential to convert the data into a JSON string
    | and log it instead so that if there's an issue, we can easily
    | debug.
    |
    | Here's a simple example where we'll just spit the data into a file
    | named by the current date and append to it so all our results can
    | be dumped to the same file.
    */
    $jsonEncoded   = json_encode($result->all());
    $jsonTimestamp = date('Ymd');

    file_put_contents("responses_{$jsonTimestamp}.json", $jsonEncoded, FILE_APPEND);

    return;
}
