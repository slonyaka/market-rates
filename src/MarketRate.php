<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.08.2020
 * Time: 21:43
 */

namespace Slonyaka\Market;


use Slonyaka\Market\ApiClient\AlphaVantageCurrencyApiClient;

class MarketRate {

	public function getCurrencyRates()
	{

		$alphavantage = 'WXSPWXNHFMV1AVZP';

		$client = new AlphaVantageCurrencyApiClient();
		$prices = $client->setApiKey($alphavantage)->pair('usd', 'eur')->setInterval('5min')->history();

		return new CurrencyMarket($prices);
	}

	public function getStockRates()
	{

	}

}