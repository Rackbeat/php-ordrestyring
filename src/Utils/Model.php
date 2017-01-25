<?php namespace LasseRafn\Ordrestyring\Utils;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use LasseRafn\Ordrestyring\Utils\ModelTraits\SetsAttributes;

class Model
{
	use SetsAttributes;

	protected $client;
	protected $fillable = [];

	const ENDPOINT    = '/';
	const PRIMARY_KEY = '/';

	/**
	 * @param Client $client
	 * @param null|array|Collection|\stdClass $data
	 */
	public function __construct( Client $client, $data )
	{
		$this->client = $client;

		if ( $data === null )
		{
			return;
		}

		if ( is_object( $data ) )
		{
			$data = (array) $data;
		}

		if ( is_array( $data ) )
		{
			$data = collect( $data );
		}

		$data->each( function ( $attribute, $key )
		{
			if ( in_array( (string) $key, $this->fillable, true ) )
			{
				$this->setAttribute($key, $attribute);
			}
		} );
	}
}