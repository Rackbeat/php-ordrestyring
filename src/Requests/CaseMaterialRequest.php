<?php

namespace LasseRafn\Ordrestyring\Requests;

use GuzzleHttp\Client;
use LasseRafn\Ordrestyring\Models\CaseMaterial;
use LasseRafn\Ordrestyring\Utils\Request;
use LasseRafn\Ordrestyring\Utils\RequestExtensions\CanCreate;
use LasseRafn\Ordrestyring\Utils\RequestExtensions\CanUpdate;

class CaseMaterialRequest extends Request
{
	use CanUpdate, CanCreate;

	protected $modelClass = CaseMaterial::class;

	public function __construct( Client $client ) {
		$this->endpoint   = CaseMaterial::ENDPOINT;
		$this->primaryKey = CaseMaterial::PRIMARY_KEY;

		parent::__construct( $client );
	}
}
