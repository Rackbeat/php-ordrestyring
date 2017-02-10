<?php namespace LasseRafn\Ordrestyring\Utils\ModelTraits;

use LasseRafn\Ordrestyring\Utils\Request;

trait CanUpdate
{
	public function update( $data )
	{
		$class = self::REQUEST_CLASS;

		/** @var \LasseRafn\Ordrestyring\Utils\RequestExtensions\CanUpdate $request */
		$request = new $class( $this->client );

		return $request->update($this->{self::PRIMARY_KEY}, $data);
	}
}