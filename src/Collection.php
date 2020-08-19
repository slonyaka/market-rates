<?php

declare(strict_types=1);

namespace Slonyaka\Market;


class Collection {

	private $collection = [];

	public $first;
	public $last;

	public function push(MarketData $marketData)
	{
		if (!count($this->collection)) {
			$this->first = $marketData;
			$this->last = $marketData;
		}

		$this->last->next = $marketData;
		$marketData->prev = $this->last;

		$this->last = $marketData;

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