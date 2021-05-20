<?php

namespace LasseRafn\Ordrestyring\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use LasseRafn\Ordrestyring\Exceptions\RequestException;

class Request extends RequestBuilder
{
    /** @var Client */
    protected $client;

    /** @var string */
    protected $primaryKey = 'id';

    /** @var string */
    protected $endpoint = '';

    /** @var Model */
    protected $modelClass;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Find one entity by the primary key.
     *
     * @param int $id
     *
     * @return Model|null
     */
    public function find(int $id)
    {
	    $this->buildRequest();

        $response = $this->getResponse(function () use ($id) {
            return $this->client->get("{$this->endpoint}/{$id}{$this->urlParameters}");
        });

        return new $this->modelClass($this->client, $response);
    }

    /**
     * Get the first entity based on the query.
     *
     * @return Model|null
     */
    public function first()
    {
        $this->page(1);
        $this->perPage(1);

        return $this->get()->first();
    }

    /**
     * Get a collection of entities based on the query.
     *
     * @return Collection
     */
    public function get()
    {
        $this->buildRequest();

        $response = $this->getResponse(function () {
            return $this->client->get("{$this->endpoint}{$this->urlParameters}");
        });

        $items = collect($response);

        return $items->map(function ($item) {
            return new $this->modelClass($this->client, $item);
        });
    }

    /**
     * Get a collection of all entities based on a query
     * This method will automatically paginate all rows,
     * and bypass any page attribute that has been set.
     *
     * @param int $chunkSize
     *
     * @return \Generator
     */
    public function all(int $chunkSize = 20)
    {
        $this->page(1);
        $this->perPage($chunkSize);

        do {
            $items = $this->get();

            $countResults = count($items);
            if ($countResults === 0) {
                break;
            }
            // make a generator of the results and return them
            // so the logic will handle them before the next iteration
            // in order to avoid memory leaks
            foreach ($items as $result) {
                yield $result;
            }

            unset($items);

            $this->page($this->getPage() + 1);
        } while ($countResults === $chunkSize);
    }

    /**
     * In some cases we return all data at once
     *
     * @return Collection
     */
    public function allAtOnce()
    {
        $generator = $this->all();

        $data = collect();
        foreach ($generator as $value) {
            $data->push($value);
        }

        return $data;
    }

    protected function getResponse(callable $callable)
    {
        try {
            /** @var Response $response */
            $response = $callable();

            return json_decode($response->getBody()->getContents());
        } catch (ClientException $clientException) {
            throw new RequestException($clientException->hasResponse() ? json_decode($clientException->getResponse()
                                                                                                       ->getBody()
                                                                                                       ->getContents())->message : $clientException->getMessage(),
                $clientException->getRequest(),
                $clientException->getResponse(),
                $clientException->getPrevious(),
                $clientException->getHandlerContext());
        }
    }
}
