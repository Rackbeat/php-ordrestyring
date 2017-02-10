<?php namespace LasseRafn\Ordrestyring\Models;

use LasseRafn\Ordrestyring\Requests\DebtorRequest;
use LasseRafn\Ordrestyring\Utils\Model;

class Debtor extends Model
{
	const ENDPOINT    = '/debtors';
	const PRIMARY_KEY = 'customer_number';
	const REQUEST_CLASS = DebtorRequest::class;

	protected $fillable = [
		'due_dates',
		'status',
		'customer_name',
		'customer_attention',
		'customer_address',
		'customer_postalcode',
		'customer_city',
		'customer_telephone',
		'customer_email',
		'customer_mobile',
		'invoice_name',
		'invoice_address',
		'invoice_postalcode',
		'invoice_city',
		'invoice_telephone',
		'invoice_email',
		'invoice_mobile',
		'cvr',
		'ean',
		'customer_remarks',
		'customer_number',
		'invoice_attention',
		'avance_type',
		'updated_at',
		'is_blocked',
		'created_at',
		'pdf_layout_id',
		'billy_handle',
		'dinero_handle',
		'internal_remark',
		'currency_id',
		'fortnox_handle',
		'fortnox_delivery_address_id',
		'invoice_social_security_number',
		'invoice_property_designation',
		'invoice_residence_association_organisation_number',
		'visma_handle',
		'termsofpayment_id',
		'invoice_countrycode'
	];

	public $due_dates;
	public $status;
	public $customer_name;
	public $customer_attention;
	public $customer_address;
	public $customer_postalcode;
	public $customer_city;
	public $customer_telephone;
	public $customer_email;
	public $customer_mobile;
	public $invoice_name;
	public $invoice_address;
	public $invoice_postalcode;
	public $invoice_city;
	public $invoice_telephone;
	public $invoice_email;
	public $invoice_mobile;
	public $cvr;
	public $ean;
	public $customer_remarks;
	public $customer_number;
	public $invoice_attention;
	public $avance_type;
	public $updated_at;
	public $is_blocked;
	public $created_at;
	public $pdf_layout_id;
	public $billy_handle;
	public $dinero_handle;
	public $internal_remark;
	public $currency_id;
	public $fortnox_handle;
	public $fortnox_delivery_address_id;
	public $invoice_social_security_number;
	public $invoice_property_designation;
	public $invoice_residence_association_organisation_number;
	public $visma_handle;
	public $termsofpayment_id;
	public $invoice_countrycode;

	/** @var null|TODO type */
	public $termsOfPayment;

	protected $casts = [
		'customer_number' => 'int',
		'is_blocked'      => 'bool',
		'updated_at'      => 'datetime',
		'created_at'      => 'datetime'
	];

	/*public function setTermsofpaymentIdAttribute( $id )
	{
		try
		{
			$this->termsOfPayment = ( new TermsOfPaymentRequest( $this->client ) )->find( $id );
		} catch ( RequestException $requestException )
		{
			$this->termsOfPayment = null;
		}

		return $id;
	}*/
}