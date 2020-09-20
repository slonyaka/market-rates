<?php

namespace Slonyaka\Market;


abstract class MarketRate {

	protected $apiKey;

	public function setApiKey(string $apiKey)
	{
		$this->apiKey = $apiKey;

		return $this;
	}

	abstract public function getRates(string $to,string $from,string $period): Collection;
}