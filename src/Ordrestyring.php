<?php namespace LasseRafn\Ordrestyring;

use GuzzleHttp\Client;
use LasseRafn\Ordrestyring\Requests\DebtorRequest;

class Ordrestyring
{
	/** @var Client */
	protected $client;

	public function __construct( string $apikey = '' )
	{
		$this->client = new Client( [
			'base_uri' => 'https://v1.api.ordrestyring.dk', // Yes, Ordrestyring defaults to http in their docs, but https has a valid certificate.
			'auth'     => [
				"{$apikey}:x",
				''
			]
		] );
	}

	public function debtors(): DebtorRequest
	{
		return new DebtorRequest( $this->client );
	}

	public function debtorInvoices()
	{
	}

	public function creditors()
	{
	}

	public function creditorInvoices()
	{
	}

	public function gps()
	{
	}

	public function internalGoods()
	{
	}

	public function paymentTerms()
	{
	}

	public function debtorCategories()
	{
	}

	public function accountPlan()
	{
	}

	public function vatTypes()
	{
	}

	public function departments()
	{
	}

	public function cases()
	{
	}

	public function caseStatuses()
	{
	}

	public function caseTypes()
	{
	}

	public function caseStatusHistory()
	{
	}

	public function caseMaterials()
	{
	}

	public function caseDocumentation()
	{
	}

	public function hours()
	{
	}

	public function employeeTypes()
	{
	}

	public function calendar()
	{
	}

	public function user()
	{
	}
}