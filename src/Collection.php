<?php

declare(strict_types=1);

namespace Slonyaka\Market;


class Collection {

	private $collection = [];

	public function push(MarketData $marketData)
	{
		$this->collection[] = $marketData;
	}

	public function read()
	{
		foreach($this->collection as $marketData) {
			yield $marketData;
		}
	}

	public function count(){
		return count($this->collection);
	}
}