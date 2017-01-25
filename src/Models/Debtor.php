<?php


namespace LasseRafn\Ordrestyring\Models;


use LasseRafn\Ordrestyring\Utils\Model;

class Debtor extends Model
{
	const ENDPOINT    = '/debtors';
	const PRIMARY_KEY = 'customer_number';

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

	protected $casts = [
		'customer_number' => 'int',
		'is_blocked'      => 'bool',
		'updated_at'      => 'datetime',
		'created_at'      => 'datetime'
	];

	public function setTermsofpaymentIdAttribute( $id )
	{
		return ( new TermsOfPaymentRequest( $this->client ) )->find( $id );
	}
}