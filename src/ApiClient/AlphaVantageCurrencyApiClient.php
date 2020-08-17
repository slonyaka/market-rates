<?php

declare(strict_types=1);

namespace Slonyaka\Market\ApiClient;


use Slonyaka\Market\Collection;
use Slonyaka\Market\MarketData;

class AlphaVantageCurrencyApiClient extends CurrencyApiClient {

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

	private $currencyFrom;
	private $currencyTo;

	private $period = self::INTERVAL_INTRADAY;
	private $interval = self::PERIOD_30_MIN;

	public function pair(string $currencyTo, string $currencyFrom): CurrencyApiClient
	{
		$this->currencyTo = strtoupper($currencyTo);
		$this->currencyFrom = strtoupper($currencyFrom);

		return $this;
	}

	public function setPeriod(string $value): CurrencyApiClient
	{
		$this->period = $value;

		return $this;
	}

	public function setInterval(string $value): CurrencyApiClient
	{
		$this->interval = $value;

		return $this;
	}

	public function latest(): Collection
	{
		$collection = new Collection();

		$url  = self::ENDPOINT;
		$url .= '?function='. self::INTERVAL_INTRADAY;
		$url .= '&from_currency='. $this->currencyFrom;
		$url .= '&to_currency='. $this->currencyTo;
		$url .= '&apikey='. $this->apiKey;

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

	public function history(): Collection
	{
		$collection = new Collection();

		$url  = self::ENDPOINT;
		$url .= '?function='. $this->period;
		$url .= '&apikey='. $this->apiKey;
		$url .= '&interval='. $this->interval;
		$url .= '&to_symbol='. $this->currencyTo;
		$url .= '&from_symbol='. $this->currencyFrom;

		$data = $this->request($url);

		$key = "Time Series FX (". $this->interval .")";

		foreach ($data[$key] as $timestamp => $value) {
			$marketData = new MarketData();

			$marketData->code = $this->currencyTo;
			$marketData->base = $this->currencyFrom;
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