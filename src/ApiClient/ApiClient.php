<?php

namespace Slonyaka\Market\ApiClient;


use Slonyaka\Market\Collection;

interface ApiClient
{

    /**
     * Get latest rate.
     * @return \Slonyaka\Market\Collection
     */
    public function latest(): Collection;

    /**
     * Get historical list of rates.
     *
     * @return \Slonyaka\Market\Collection
     */
    public function history(): Collection;

}
