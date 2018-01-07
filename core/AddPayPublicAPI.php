<?php

require 'vendor/autoload.php';

class AddPayPublicAPI extends AddPay\Foundation\Protocol\API\PublicAPI {}

$public = new AddPayPublicAPI();
