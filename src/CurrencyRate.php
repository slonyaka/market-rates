<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 20.09.2020
 * Time: 16:03
 */

namespace Slonyaka\Market;


use Slonyaka\Market\ApiClient\AlphaVantageCurrencyApiClient;

class CurrencyRate extends MarketRate {

	public function getRates(string $to,string $from,string $period): Collection
	{
		$client = new AlphaVantageCurrencyApiClient();
		return $client->setApiKey($this->apiKey)->pair($to, $from)->setInterval($period)->history();
	}
}