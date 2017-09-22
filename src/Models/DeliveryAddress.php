<?php namespace LasseRafn\Ordrestyring\Models;

use LasseRafn\Ordrestyring\Requests\DeliveryAddressRequest;
use LasseRafn\Ordrestyring\Utils\Model;

class DeliveryAddress extends Model
{
	const ENDPOINT      = '/delivery-addresses';
	const PRIMARY_KEY   = 'id';
	const REQUEST_CLASS = DeliveryAddressRequest::class;

	public $id;
	public $name;
	public $address;
	public $city;
	public $postalcode;
	public $telephone;
	public $mobile;
	public $att;
	public $ean;
	public $email;
	public $updated_at;
	public $created_at;
	public $customer_number;

	protected $casts = [
		'id'         => 'int',
		'updated_at' => 'datetime',
		'created_at' => 'datetime'
	];
}