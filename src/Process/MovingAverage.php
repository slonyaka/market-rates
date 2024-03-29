<?php


namespace Slonyaka\Market\Process;


use Slonyaka\Market\Collection;

class MovingAverage
{

    /**
     * Count avarages for rates collection.
     *
     * @param \Slonyaka\Market\Collection $collection
     *
     * @return array
     */
    public function count(Collection $collection)
    {
        $result = [];

        foreach ($collection->read() as $marketData) {
            $result[$marketData->time] = ($marketData->highPrice + $marketData->lowPrice) / 2;
        }

        return $result;
    }

}