<?php


namespace Slonyaka\Market;


use Slonyaka\Market\ApiClient\AlphaVantageCurrencyApiClient;

/**
 * Class CurrencyRateFactory
 * @package Slonyaka\Market
 */
class CurrencyRateFactory
{
    /**
     * @param string $apiKey
     * @return MarketRate
     */
    public static function make(string $apiKey): MarketRate
    {
        $apiClient = new AlphaVantageCurrencyApiClient($apiKey);
        return new CurrencyRate($apiClient);
    }
}
