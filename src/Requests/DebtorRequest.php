<?php namespace LasseRafn\Ordrestyring\Requests;

use GuzzleHttp\Client;
use LasseRafn\Ordrestyring\Models\Debtor;
use LasseRafn\Ordrestyring\Utils\Request;
use LasseRafn\Ordrestyring\Utils\RequestExtensions\CanCreate;
use LasseRafn\Ordrestyring\Utils\RequestExtensions\CanUpdate;

class DebtorRequest extends Request
{
	use CanUpdate, CanCreate;

	protected $modelClass = Debtor::class;

	public function __construct( Client $client )
	{
		$this->endpoint   = Debtor::ENDPOINT;
		$this->primaryKey = Debtor::PRIMARY_KEY;

		parent::__construct( $client );
	}
}