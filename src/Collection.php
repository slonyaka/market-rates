<?php

declare(strict_types=1);

namespace Slonyaka\Market;


use Generator;

class Collection
{

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

    public function read(): Generator
    {
        foreach ($this->collection as $marketData) {
            yield $marketData;
        }
    }

    public function readFromEnd(): Generator
    {
        $item = $this->last;

        while ($item) {
            $current = $item;
            $item = $item->prev;
            yield $current;
        }
    }

    public function count(): int
    {
        return count($this->collection);
    }

}
