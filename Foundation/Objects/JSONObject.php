<?php

namespace AddPay\Foundation\Objects;

class JSONObject
{
    public $resource;
    public $protocol;

    public function __construct(array $data, $protocol = false)
    {
        $this->resource = $data;
        $this->protocol = $protocol;
    }

    public function gotExpectedResult()
    {
        return (isset($this->resource->meta) && substr($this->resource->meta['code'], 0, 1) == '2');
    }

    public function succeeds()
    {
        return $this->gotExpectedResult();
    }

    public function fails()
    {
        return !$this->succeeds();
    }

    public function getErrorCode()
    {
        return $this->resource->meta['code'] ?? 500;
    }

    public function getErrorMessage()
    {
        return $this->resource->meta['message'] ?? 'Internal exception';
    }

    public function __call($name, $args)
    {
        if (substr($name, 0, 4) == 'with') {
            $arr = preg_split('/(?=[A-Z])/', substr($name, 4));
            $count = 0;
            $max = count($arr);

            $temp = &$this->resource;
            foreach ($arr as $key) {
                $count++;
                if (strlen($key)) {
                    $temp = &$temp[strtolower($key)];
                }

                if ($count == $max) {
                    $temp = $args[0];
                }
            }
            unset($temp);

            return $this;
        } else {
            if ($this->protocol) {
                return $this->protocol->{$name}(...$args);
            } else {
                throw new \Exception("No such function '{$name}'. Read the documentation.");
            }
        }
    }

    public function withAmountCurrencyCode($code)
    {
        $this->resource['amount']['currency_code'] = $code;

        return $this;
    }

    public function withContractMaxAmount($amount)
    {
        $this->resource['contract']['max_amount'] = $amount;

        return $this;
    }

    public function withInitiatesAt($date)
    {
        $this->resource['initiates_at'] = $date;

        return $this;
    }
}
