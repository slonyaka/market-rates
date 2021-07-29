<?php

namespace Slonyaka\Market\ApiClient;


use Slonyaka\Market\Collection;

interface ApiClient {
	public function latest(): Collection;
	public function history(): Collection;
}
