<?php namespace LasseRafn\Ordrestyring\Utils\RequestExtensions;

trait CanCreate
{
	public function create( $data )
	{
		$response = $this->getResponse( function ()
		{
			return $this->client->post( "{$this->endpoint}" );
		} );
	}
}