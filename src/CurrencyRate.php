<?php

namespace Slonyaka\Market;


/**
 * Class CurrencyRate
 * @package Slonyaka\Market
 */
class CurrencyRate extends MarketRate {

    /**
     * @param string $to
     * @param string $from
     * @param string $period
     * @return Collection
     */
    public function getRates(string $to, string $from, string $period): Collection
	{
		return $this->apiClient->pair($to, $from)->setInterval($period)->history();
	}
}
