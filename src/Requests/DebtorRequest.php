<?php namespace LasseRafn\Ordrestyring\Requests;

use LasseRafn\Ordrestyring\Utils\Request;
use LasseRafn\Ordrestyring\Utils\RequestExtensions\CanCreate;
use LasseRafn\Ordrestyring\Utils\RequestExtensions\CanUpdate;

class DebtorRequest extends Request
{
	use CanUpdate, CanCreate;

	protected $endpoint   = '/debtasdors';
	protected $primaryKey = 'customer_number';
}