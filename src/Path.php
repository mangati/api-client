<?php

namespace Mangati\Api;

use Exception;

/**
 * Path
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class Path
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client, string $baseUrl)
    {
        $this->client  = $client;
        $this->baseUrl = $baseUrl;
        $this->request = new Request();
    }

    /**
     * Returns all items (Method GET)
     * @param array $params
     * @return array
     */
    public function getAll(array $params = []): array
    {
        return $this->request->do('GET', $this->baseUrl, $params, $this->client->session()->headers);
    }

    /**
     * Returns the item by id (Method GET)
     * @param mixed $id
     * @return array
     */
    public function get($id): array
    {
        return $this->request->do('GET', "{$this->baseUrl}/{$id}", [], $this->client->session()->headers);
    }

    /**
     * Append a item to collection (Method POST)
     * @param array $data
     * @return array
     */
    public function add(array $data): array
    {
        return $this->request->do('POST', $this->baseUrl, $data, $this->client->session()->headers);
    }

    /**
     * Update existing item (Method PUT)
     * @param mixed $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data): array
    {
        return $this->request->do('PUT', "{$this->baseUrl}/{$id}", $data, $this->client->session()->headers);
    }

    /**
     * Delete existing item (Method DELETE)
     * @param mixed $id
     * @return array
     */
    public function delete($id): array
    {
        return $this->request->do('DELETE', "{$this->baseUrl}/{$id}", [], $this->client->session()->headers);
    }
}
