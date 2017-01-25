<?php namespace LasseRafn\Ordrestyring\Utils\RequestExtensions;

trait CanUpdate
{
	public function update( $primaryKey, $data )
	{
		return $this->getResponse( function () use ( $primaryKey, $data )
		{
			return $this->client->put( "{$this->endpoint}/{$primaryKey}", [
				'json' => $data
			] );
		} );
	}
}