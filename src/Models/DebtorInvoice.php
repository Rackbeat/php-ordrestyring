<?php namespace LasseRafn\Ordrestyring\Models;

use LasseRafn\Ordrestyring\Requests\DebtorInvoiceRequest;
use LasseRafn\Ordrestyring\Utils\Model;

class DebtorInvoice extends Model
{
	const ENDPOINT      = '/debtor-invoices';
	const PRIMARY_KEY   = 'invoice_number';
	const REQUEST_CLASS = DebtorInvoiceRequest::class;

	public $type;
	public $customer_number;
	public $case_number;
	public $department;
	public $invoice_name;
	public $invoice_address;
	public $invoice_postalcode;
	public $invoice_city;
	public $cust_name;
	public $cust_address;
	public $cust_postalcode;
	public $cust_city;
	public $del_name;
	public $del_address;
	public $del_city;
	public $del_postalcode;
	public $text;
	public $date;
	public $payment_date;
	public $ref;
	public $rek;
	public $made_by;
	public $amount;
	public $vat;
	public $amount_vat;
	public $fi_number;
	public $header;
	public $status;
	public $del_att;
	public $cust_att;
	public $invoice_att;
	public $payed_date;
	public $payed_amount;
	public $invoice_number;
	public $updated_at;
	public $created_at;
	public $cust_cvr;
	public $use_skattered;

	protected $casts = [
		'customer_number' => 'int',
		'use_skattered'   => 'bool',
		'updated_at'      => 'datetime',
		'created_at'      => 'datetime'
	];

	public function getPdf()
	{
		return $this->client->get( self::ENDPOINT + '/' . $this->{self::PRIMARY_KEY} . '.pdf' );
	}
}