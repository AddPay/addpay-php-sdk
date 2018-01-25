<?php

namespace AddPay\Foundation\Protocol\API;

use AddPay\Foundation\Protocol\CurrencyProtocol;
use AddPay\Foundation\Protocol\CountryProtocol;

class PublicAPI extends BaseAPI
{
    /**
     * The currency protocol container.
     *
     * @var CurrencyProtocol
     */
    private $currencies;

    /**
     * The country protocol container.
     *
     * @var CountryProtocol
     */
    private $countries;

    /**
     * Basically a bootstrapper for the core API class,
     * ensures config integrity and throws an exception
     * if there are issues with the config.
     *
     * @return void
     *
     */
    public function __construct($configDir = null)
    {
        parent::__construct($configDir);

        $this->baseUrl = boolval($this->config['live']) === true ? 'https://www.addpay.co.za' : 'https://secure-test.addpay.co.za';

        $this->currencies = new CurrencyProtocol($this);
        $this->countries = new CountryProtocol($this);
    }

    /**
     * Returns the currency protocol container
     *
     * @return CurrencyProtocol
     *
     */
    public function currencies()
    {
        return $this->currencies;
    }

    /**
     * Returns the country protocol container
     *
     * @return CountryProtocol
     *
     */
    public function countries()
    {
        return $this->countries;
    }
}
