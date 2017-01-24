<?php namespace LasseRafn\Ordrestyring\Utils\RequestExtensions;

trait CanDelete
{
	public function delete( $primaryKey )
	{
		$response = $this->getResponse( function ()
		{
			return $this->client->delete( "{$this->endpoint}" );
		} );
	}
}