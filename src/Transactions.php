<?php

namespace PomeloPHP;

class Transactions
{
    const ENDPOINT = 'transactions';

    /**
     * @var Client
     */
    private $client;

    /**
     * Payments constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function all($filters = [])
    {
        return $this->client->get('transactions?'.http_build_query($filters));
    }

    /**
     * @param string $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $id)
    {
        return $this->client->get(self::ENDPOINT.'/'.$id);
    }

    /**
     * @param array $json
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $json)
    {
        return $this->client->post(self::ENDPOINT, $json);
    }

}
