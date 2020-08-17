<?php


namespace Slonyaka\Market;



use Slonyaka\Market\Process\Average;
use Slonyaka\Market\Process\Power;

class CurrencyMarket {

	private $collection;

	public function __construct(Collection $collection) {
		$this->collection = $collection;
	}

	public function getAverage()
	{
		$process = new Average();

		return $process->count($this->collection);

	}

	public function getPower() {

		$process = new Power();
		return $process->count($this->collection);
	}

}