<?php

namespace Slonyaka\Market\ApiClient;


use GuzzleHttp\Client;
use Slonyaka\Market\Collection;

abstract class CurrencyApiClient implements ApiClient {

	protected $apiKey;

	public function setApiKey(string $apiKey): self
	{
		$this->apiKey = $apiKey;

		return $this;
	}

	protected function request($url)
	{
		$client = new Client();

		try{
			$response = $client->get($url);
		} catch (\Exception $e)
		{
			die( $e->getMessage());
		}

		if ($response->getStatusCode() === 200) {
			return \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
		}

		return [];
	}

	abstract public function pair(string $from, string $to): self;
	abstract public function setPeriod(string $from): self;
	abstract public function setInterval(string $from): self;
	abstract public function latest(): Collection;
	abstract public function history(): Collection;

}