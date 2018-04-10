<?php

namespace PomeloPHP;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;

class Client
{
    const POMELO_API_VERSION = '1.0';
    const POMELO_SANDBOX_ENDPOINT = 'https://sandbox.pomelopay.com/api/';
    const POMELO_PRODUCTION_ENDPOINT = 'https://app.pomelopay.com/api/';

    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $appId;

    /**
     * @var string
     */
    private $mode;

    /**
     * @var array
     */
    private $clientOptions;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var Transactions
     */
    public $transactions;


    /**
     * Client constructor.
     * @param string $apiKey
     * @param string $appId
     * @param string $mode
     * @param array $clientOptions
     */
    public function __construct(string $apiKey, string $appId, $mode = 'production', array $clientOptions = [])
    {
        $this->apiKey = $apiKey;
        $this->appId = $appId;
        $this->mode = $mode;
        $this->baseUrl = ($mode === 'production' ? self::POMELO_PRODUCTION_ENDPOINT : self::POMELO_SANDBOX_ENDPOINT);
        $this->clientOptions = $clientOptions;

        $this->initiateHttpClient();

        $this->transactions = new Transactions($this);
    }

    /**
     * @param GuzzleClient $client
     */
    public function setClient(GuzzleClient $client)
    {
        $this->httpClient = $client;
    }

    /**
     * Initiates the HttpClient with required headers
     */
    private function initiateHttpClient()
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ]
        ];

        $this->httpClient = new GuzzleClient(array_replace_recursive($this->clientOptions, $options));
    }

    private function buildBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param Response $response
     * @return mixed
     */
    private function handleResponse(Response $response)
    {
        $stream = \GuzzleHttp\Psr7\stream_for($response->getBody());
        $data = json_decode($stream);

        return $data;
    }

    /**
     * @param string $endpoint
     * @param array $json
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($endpoint, $json)
    {
        $json['deviceId'] = $this->appId;
        $json['appVersion'] = self::POMELO_API_VERSION;

        $response = $this->httpClient->request('POST', $this->buildBaseUrl().$endpoint, ['json' => $json]);
        return $this->handleResponse($response);
    }

    /**
     * @param string $endpoint
     * @param array $pagination
     * @return mixed
     */
    public function get(string $endpoint, array $pagination = [])
    {
        $response = $this->httpClient->request(
            'GET',
            $this->applyPagination($this->buildBaseUrl().$endpoint, $pagination)
        );

        return $this->handleResponse($response);
    }

    /**
     * @param string $url
     * @param array $pagination
     * @return string
     */
    private function applyPagination(string $url, array $pagination)
    {
        if (count($pagination)) {
            return $url.'?'.http_build_query($this->cleanPagination($pagination));
        }

        return $url;
    }

    /**
     * @param array $pagination
     * @return array
     */
    private function cleanPagination(array $pagination)
    {
        $allowed = [
            'page',
            'pagination',
            'itemsPerPage',
        ];

        return array_intersect_key($pagination, array_flip($allowed));
    }
}
