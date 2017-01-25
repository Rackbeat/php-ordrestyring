<?php namespace LasseRafn\Ordrestyring\Utils;

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

	public function __construct( Client $client )
	{
		$this->client = $client;
	}

	/**
	 * Find one entity by the primary key
	 *
	 * @param int $id
	 *
	 * @return Model|null
	 */
	public function find( int $id )
	{
		$response = $this->getResponse( function () use ( $id )
		{
			return $this->client->get( "{$this->endpoint}/{$id}" );
		} );

		return new $this->modelClass( $response );
	}

	/**
	 * Get the first entity based on the query
	 *
	 * @return Model|null
	 */
	public function first()
	{
		$this->page( 1 );
		$this->perPage( 1 );
		$this->get();

		$this->buildRequest();

		/** @var array $response */
		$response = $this->getResponse( function ()
		{
			return $this->client->get( "{$this->endpoint}{$this->urlParameters}" );
		} );

		if ( count( $response ) === 0 )
		{
			return null;
		}

		return new $this->modelClass( $response[0] );
	}

	/**
	 * Get a collection of entities based on the query
	 *
	 * @return Collection
	 */
	public function get()
	{
		$this->buildRequest();

		/** @var array $response */
		$response = $this->getResponse( function ()
		{
			return $this->client->get( "{$this->endpoint}{$this->urlParameters}" );
		} );

		$items = collect( $response );

		return $items->map( function ( $item )
		{
			return new $this->modelClass( $item );
		} );
	}

	/**
	 * Get a collection of all entities based on a query
	 * This method will automatically paginate all rows,
	 * and bypass any page attribute that has been set.
	 *
	 * @return Collection
	 */
	public function all()
	{
		$this->buildRequest();

		$response = $this->getResponse( function ()
		{
			return $this->client->get( "{$this->endpoint}{$this->urlParameters}" );
		} );

		$items = collect( $response );

		return $items->map( function ( $item )
		{
			return new $this->modelClass( $item );
		} );
	}

	private function getResponse( callable $callable )
	{
		try
		{
			/** @var Response $response */
			$response = $callable();

			return json_decode( $response->getBody()->getContents() );
		} catch ( ClientException $clientException )
		{
			throw new RequestException( $clientException->hasResponse() ? json_decode( $clientException->getResponse()
			                                                                                           ->getBody()
			                                                                                           ->getContents() )->message : $clientException->getMessage(),
				$clientException->getRequest(),
				$clientException->getResponse(),
				$clientException->getPrevious(),
				$clientException->getHandlerContext() );
		}
	}
}