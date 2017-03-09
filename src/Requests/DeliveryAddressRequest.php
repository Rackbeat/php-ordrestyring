<?php namespace LasseRafn\Ordrestyring\Requests;

use GuzzleHttp\Client;
use LasseRafn\Ordrestyring\Models\DeliveryAddress;
use LasseRafn\Ordrestyring\Utils\Request;

class DeliveryAddressRequest extends Request
{
	use CanUpdate, CanCreate;

	protected $modelClass = DeliveryAddress::class;

	public function __construct( Client $client )
	{
		$this->endpoint   = DeliveryAddress::ENDPOINT;
		$this->primaryKey = DeliveryAddress::PRIMARY_KEY;

		parent::__construct( $client );
	}
}