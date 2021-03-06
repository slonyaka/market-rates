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
		}

		if ($this->last) {
			$this->last->next = $marketData;
			$marketData->prev = $this->last;
		}

		$this->last = $marketData;

		$this->collection[] = $marketData;
	}

	public function read()
	{
		foreach($this->collection as $marketData) {
			yield $marketData;
		}
	}

	public function readFromEnd()
	{
		$item = $this->last;

		while($item) {
			$current = $item;
			$item = $item->prev;
			yield $current;
		}
	}

	public function count()
    {
		return count($this->collection);
	}

    /**
     * TODO these methods must have logic how to compare items in Collection
     */
	public function min()
    {
        return min($this->collection);
    }

    public function max()
    {
        return max($this->collection);
    }
}