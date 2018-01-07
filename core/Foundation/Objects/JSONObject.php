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

    /**
     * Returns true if the expected JSON result is found.
     *
     * @return boolean
     */
    public function gotExpectedResult()
    {
        return (isset($this->resource['meta']) && substr($this->resource['meta']['code'], 0, 1) == '2');
    }

    /**
     * An alias for gotExpectedResult().
     *
     * @return boolean
     */
    public function succeeds()
    {
        return $this->gotExpectedResult();
    }

    /**
     * Returns true if the expected JSON result is not found.
     *
     * @return boolean
     */
    public function fails()
    {
        return !$this->succeeds();
    }

    /**
     * Retreive the HTTP response code.
     *
     * @return int
     */
    public function getErrorCode()
    {
        return $this->resource['meta']['code'] ?? 500;
    }

    /**
     * Retreive the HTTP payload message.
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->resource['meta']['message'] ?? 'Internal exception';
    }

    /**
     * Magic method that catches undefined functions
     * looks for custom magic method and returns the
     * result.
     *
     * An exception is thrown is the function does not exist
     * and it is not a magic method.
     *
     * @return mixed
     */
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
        } elseif ((substr($name, 0, 3) == 'get')) {
            $arr = preg_split('/(?=[A-Z])/', substr($name, 3));
            $arr = array_filter($arr, function ($item) {
                return strlen($item);
            });

            $spair = strtolower(implode('', $arr));

            $ritit = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($this->resource));

            $result = null;

            foreach ($ritit as $leafValue) {
                $keys = array();

                foreach (range(0, $ritit->getDepth()) as $depth) {
                    $keys[] = $ritit->getSubIterator($depth)->key();

                    $pair = strtolower(implode('', $keys));

                    if ($pair == $spair) {
                        $result = $ritit->getSubIterator($depth)->current();
                        break;
                    }
                }

                if (!is_null($result)) {
                    break;
                }
            }

            return $result;
        } else {
            if ($this->protocol) {
                return $this->protocol->{$name}(...$args);
            } else {
                throw new \Exception("You're doing it wrong. Read the documentation.");
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

    public function withInstrumentExpiryMonth($month)
    {
        $this->resource['instrument']['expiry_month'] = $month;

        return $this;
    }

    public function withInstrumentExpiryYear($year)
    {
        $this->resource['instrument']['expiry_year'] = $year;

        return $this;
    }

    public function getStatusReason()
    {
        return $this->resource['status_reason'] ?? '';
    }

    public function getAmountCurrencyCode()
    {
        return $this->resource['amount']['currency_code'] ?? '';
    }

    public function getInitiatesAt()
    {
        return $this->resource['initiates_at'] ?? '';
    }

    public function getCompletedAt()
    {
        return $this->resource['completed_at'] ?? '';
    }

    public function getCallToAction()
    {
        return $this->resource['call_to_action'] ?? '';
    }
}
