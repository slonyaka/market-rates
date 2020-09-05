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

	public function getCurrencyRates($to, $from, $period)
	{

		$alphavantage = 'WXSPWXNHFMV1AVZP';

		$client = new AlphaVantageCurrencyApiClient();
		$prices = $client->setApiKey($alphavantage)->pair($to, $from)->setInterval($period)->history();

		return new CurrencyMarket($prices);
	}

	public function getStockRates()
	{

	}

}