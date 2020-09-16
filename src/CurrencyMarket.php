<?php


namespace Slonyaka\Market;


use Slonyaka\Market\Process\Average;

class CurrencyMarket {

	private $collection;

	public function __construct(Collection $collection) {
		$this->collection = $collection;
	}

	public function getRates()
	{
		return $this->collection;
	}

	public function getAverage()
	{
		$process = new Average();

		return $process->count($this->collection);

	}

}