<?php

namespace Slonyaka\Market;


use Slonyaka\Market\ApiClient\ApiClient;

/**
 * Class MarketRate
 * @package Slonyaka\Market
 */
abstract class MarketRate {

    /**
     * @var ApiClient
     */
    protected $apiClient;

    /**
     * MarketRate constructor.
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @param string $to
     * @param string $from
     * @param string $period
     * @return Collection
     */
    abstract public function getRates(string $to,string $from,string $period): Collection;
}
