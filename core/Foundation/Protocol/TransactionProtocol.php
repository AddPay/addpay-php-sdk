<?php

namespace AddPay\Foundation\Protocol;

use AddPay\Foundation\Protocol\BaseProtocol;

class TransactionProtocol extends BaseProtocol
{
    /**
     * Extending endpoint of the BaseProtocol
     *
     * @var string
     */
    protected $endpoint = '/v2/transactions';

    /**
     * Special primary function to set query parameters specifically
     * for the transactions endpoint in order limit the number of results
     *
     * @return mixed
     *
     */
    public function withPageLimit($limit)
    {
        $this->queryParams .= "limit={$limit}&";

        return $this;
    }

    /**
     * Special primary function to set query parameters specifically
     * for the transactions endpoint in order set the viewing page number
     *
     * @return mixed
     *
     */
    public function withPageNumber($page)
    {
        $this->queryParams .= "page={$page}&";

        return $this;
    }

    /**
     * Special primary function to set query parameters specifically
     * for the transactions date range.
     *
     * @return mixed
     *
     */
    public function withinIdentifierRange(array $range)
    {
        $rangeList = implode(',', $range);

        $this->queryParams .= "id~$rangeList&";

        return $this;
    }

    /**
     * Special primary function to set query parameters specifically
     * for the transactions ID range.
     *
     * @return mixed
     *
     */
    public function withinDateRange($from, $to)
    {
        $this->queryParams .= "created_at>={$from}&created_at<={$to}&";

        return $this;
    }

    /**
     * Special primary function to set query parameters specifically
     * for the transaction intent type.
     *
     * @return mixed
     *
     */
    public function onlySubscriptions()
    {
        $this->queryParams .= "intent=SUBSCRIPTION&";

        return $this;
    }

    /**
     * Special primary function to set query parameters specifically
     * for the transaction intent type.
     *
     * @return mixed
     *
     */
    public function onlyOnceOffs()
    {
        $this->queryParams .= "intent=SALE&";

        return $this;
    }

    /**
     * Create new instance of an empty transaction object
     *
     * @return mixed
     *
     */
    public function instantiate($protocol = false)
    {
        return parent::instantiate(array(), $this);
    }
}
