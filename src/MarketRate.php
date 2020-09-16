<?php

namespace Slonyaka\Market;


use Slonyaka\Market\ApiClient\AlphaVantageCurrencyApiClient;

class MarketRate {

	private $apiKey;

	public function setApiKey(string $apiKey)
	{
		$this->apiKey = $apiKey;

		return $this;
	}

	public function getCurrencyRates($to, $from, $period)
	{
		$client = new AlphaVantageCurrencyApiClient();
		$prices = $client->setApiKey($this->apiKey)->pair($to, $from)->setInterval($period)->history();

		return new CurrencyMarket($prices);
	}

	public function getStockRates()
	{

	}

}