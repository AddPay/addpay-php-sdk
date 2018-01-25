<?php

namespace AddPay\Foundation\Protocol;

use AddPay\Foundation\Protocol\BaseProtocol;

class CountryProtocol extends BaseProtocol
{
    /**
     * Extending endpoint of the BaseProtocol
     *
     * @var string
     */
    protected $endpoint = '/meta/countries';

}
