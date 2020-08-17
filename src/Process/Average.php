<?php


namespace Slonyaka\Market\Process;


use Slonyaka\Market\Collection;

class Average {

	public function count(Collection $collection)
	{
		$result = [];

		foreach ($collection->read() as $marketData) {
			$result[$marketData->time] = ($marketData->highPrice + $marketData->lowPrice) /2;
		}

		return $result;
	}
}