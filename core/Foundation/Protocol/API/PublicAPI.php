<?php

namespace AddPay\Foundation\Protocol\API;

class PublicAPI extends BaseAPI
{
  /**
   * Basically a bootstrapper for the core API class,
   * ensures config integrity and throws an exception
   * if there are issues with the config.
   *
   * @return void
   *
   */
    public function __construct()
    {
        parent::__construct();
    }
}
