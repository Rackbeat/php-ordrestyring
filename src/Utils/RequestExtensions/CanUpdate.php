<?php namespace LasseRafn\Ordrestyring\Utils\RequestExtensions;

trait CanUpdate
{
	public function update( $primaryKey, $data )
	{
		$response = $this->getResponse( function ()
		{
			return $this->client->put( "{$this->endpoint}" );
		} );
	}
}