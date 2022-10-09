<?php

namespace Slonyaka\Market\ApiClient;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Slonyaka\Market\Collection;

/**
 * Class CurrencyApiClient
 *
 * @package Slonyaka\Market\ApiClient
 */
abstract class CurrencyApiClient implements ApiClient
{

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * CurrencyApiClient constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $url
     *
     * @return array|bool|float|int|object|string|null
     * @throws GuzzleException
     */
    protected function request(string $url)
    {
        $client = new Client();

        try {
            $response = $client->get($url);
        } catch (GuzzleException $e) {
            die($e->getMessage());
        }

        if ($response->getStatusCode() === 200) {
            return \GuzzleHttp\json_decode($response->getBody()->getContents(),
              true);
        }

        return [];
    }

    /**
     * @param string $from
     * @param string $to
     *
     * @return $this
     */
    abstract public function pair(string $to, string $from): self;

    /**
     * @param string $from
     *
     * @return $this
     */
    abstract public function setPeriod(string $from): self;

    /**
     * @param string $from
     *
     * @return $this
     */
    abstract public function setInterval(string $from): self;

    /**
     * @return Collection
     */
    abstract public function latest(): Collection;

    /**
     * @return Collection
     */
    abstract public function history(): Collection;

}