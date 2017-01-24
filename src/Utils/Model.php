<?php namespace LasseRafn\Ordrestyring\Utils;


use Illuminate\Support\Collection;

class Model
{
	protected $fillable   = [];
	protected $endpoint   = '/';
	protected $primaryKey = 'id';

	/**
	 * @param null|array|Collection|\stdClass $data
	 */
	public function __construct( $data )
	{
		if( $data === null)
		{
			return;
		}

		if ( is_object( $data ) )
		{
			$data = collect( (array) $data );
		}

		if ( is_array( $data ) )
		{
			$data = collect( $data );
		}

		// todo.
	}
}