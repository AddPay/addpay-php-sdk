<?php

require_once(__DIR__ . '/../../core/bootstrap.php');

$services = array();

$api = new OpenAPI();

$http = $api->services()
            ->withType('transaction')
            ->withIntent('SALE')
            ->list();

if ($http->succeeds()) {
    $services = $http->all();
}

$templateIncludes = array(
  __DIR__ . '/HTML/HTMLServiceList.tpl',
);

require_once(__DIR__ . '/HTML/HTMLLayout.tpl');
