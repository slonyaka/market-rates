<?php

declare(strict_types=1);

namespace Slonyaka\Market\ApiClient;


use GuzzleHttp\Exception\GuzzleException;
use Slonyaka\Market\Collection;
use Slonyaka\Market\MarketData;

/**
 * Class AlphaVantageCurrencyApiClient
 *
 * @package Slonyaka\Market\ApiClient
 */
class AlphaVantageCurrencyApiClient extends CurrencyApiClient
{

    const ENDPOINT = 'https://www.alphavantage.co/query';

    const PERIOD_1_MIN = '1min';

    const PERIOD_5_MIN = '5min';

    const PERIOD_15_MIN = '15min';

    const PERIOD_30_MIN = '30min';

    const PERIOD_60_MIN = '60min';

    const INTERVAL_LATEST = 'CURRENCY_EXCHANGE_RATE';

    const INTERVAL_INTRADAY = 'FX_INTRADAY';

    const INTERVAL_DAILY = 'FX_DAILY';

    const INTERVAL_WEEKLY = 'FX_WEEKLY';

    private $to;

    private $from;

    private $period = self::INTERVAL_INTRADAY;

    private $interval = self::PERIOD_30_MIN;

    /**
     * @param string $to
     * @param string $from
     *
     * @return CurrencyApiClient
     */
    public function pair(string $to, string $from): CurrencyApiClient
    {
        $this->to = strtoupper($to);
        $this->from = strtoupper($from);

        return $this;
    }

    public function setPeriod(string $from): CurrencyApiClient
    {
        $this->period = $from;

        return $this;
    }

    public function setInterval(string $from): CurrencyApiClient
    {
        $this->interval = $from;

        return $this;
    }

    /**
     * @throws GuzzleException
     */
    public function latest(): Collection
    {
        $collection = new Collection();

        $url = self::ENDPOINT;
        $url .= '?function=' . self::INTERVAL_INTRADAY;
        $url .= '&from_currency=' . $this->from;
        $url .= '&to_currency=' . $this->to;
        $url .= '&apikey=' . $this->apiKey;

        $data = $this->request($url);

        $marketData = new MarketData();

        $key = 'Realtime Currency Exchange Rate';

        $marketData->code = $data[$key]["3. To_Currency Code"];
        $marketData->base = $data[$key]["1. From_Currency Code"];
        $marketData->price = $data[$key]["5. Exchange Rate"];
        $marketData->time = $data[$key]["6. Last Refreshed"];
        $marketData->bidPrice = $data[$key]["8. Bid Price"];
        $marketData->askPrice = $data[$key]["9. Ask Price"];

        $collection->push($marketData);

        return $collection;
    }

    /**
     * @throws GuzzleException
     */
    public function history(): Collection
    {
        $collection = new Collection();

        $url = self::ENDPOINT;
        $url .= '?function=' . $this->period;
        $url .= '&apikey=' . $this->apiKey;
        $url .= '&interval=' . $this->interval;
        $url .= '&to_symbol=' . $this->to;
        $url .= '&from_symbol=' . $this->from;

        $data = $this->request($url);

        $key = "Time Series FX (" . $this->interval . ")";

        foreach ($data[$key] as $timestamp => $value) {
            $marketData = new MarketData();

            $marketData->code = $this->to;
            $marketData->base = $this->from;
            $marketData->time = $timestamp;
            $marketData->openPrice = $value["1. open"];
            $marketData->closePrice = $value["4. close"];
            $marketData->highPrice = $value["2. high"];
            $marketData->lowPrice = $value["3. low"];

            $collection->push($marketData);
        }

        return $collection;
    }

}
