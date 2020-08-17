<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 16.08.2020
 * Time: 19:22
 */

namespace Slonyaka\Market\Process;


use Slonyaka\Market\Collection;

class Power {

	public function count(Collection $collection)
	{
		$prev = null;
		$min = null;
		$max = null;
		$topward = 0;
		$downward = 0;
		$first = 0;
		$last = 0;
		$topPower = 0;
		$downPower = 0;


		foreach ($collection->read() as $marketData) {
			if (empty($prev)) {
				$prev = $marketData;
				$min = $max = $first = $marketData->closePrice;
				continue;
			}

			if ($min >= $marketData->closePrice) {
				$min = $marketData->closePrice;
				$downward += 1;
				$downPower += $prev->closePrice;
			}

			if ($max < $marketData->closePrice) {
				$max = $marketData->closePrice;
				$topward += 1;
				$topPower += $prev->closePrice;
			}

			$last = $marketData->closePrice;

			$prev = $marketData;
		}

		return [
			'min' => $min,
			'max' => $max,
			'topward' => $topward,
			'downward' => $downward,
			'first' => $first,
			'last' => $last,
			'downPower' => $downPower,
			'topPower' => $topPower
		];
	}

}