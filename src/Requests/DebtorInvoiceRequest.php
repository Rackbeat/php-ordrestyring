<?php namespace LasseRafn\Ordrestyring\Requests;

use GuzzleHttp\Client;
use LasseRafn\Ordrestyring\Models\DebtorInvoice;
use LasseRafn\Ordrestyring\Utils\Request;
use LasseRafn\Ordrestyring\Utils\RequestExtensions\CanCreate;
use LasseRafn\Ordrestyring\Utils\RequestExtensions\CanUpdate;

class DebtorInvoiceRequest extends Request
{
	use CanUpdate, CanCreate;

	protected $modelClass = DebtorInvoice::class;

	public function __construct( Client $client )
	{
		$this->endpoint   = DebtorInvoice::ENDPOINT;
		$this->primaryKey = DebtorInvoice::PRIMARY_KEY;

		parent::__construct( $client );
	}
}