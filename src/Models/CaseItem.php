<?php namespace LasseRafn\Ordrestyring\Models;

use LasseRafn\Ordrestyring\Exceptions\RequestException;
use LasseRafn\Ordrestyring\Requests\CaseItemRequest;
use LasseRafn\Ordrestyring\Requests\DebtorRequest;
use LasseRafn\Ordrestyring\Utils\Model;
use LasseRafn\Ordrestyring\Utils\ModelTraits\CanUpdate;

class CaseItem extends Model
{
	use CanUpdate;

	const ENDPOINT    = '/cases';
	const PRIMARY_KEY = 'case_number';
	const REQUEST_CLASS = CaseItemRequest::class;

	protected $fillable = [
		'ourref',
		'requestor',
		'creation_date',
		'error_type',
		'description',
		'main_technician',
		'status',
		'scanstatus',
		'made_by',
		'perform_time_from',
		'perform_time_to',
		'repeat',
		'repeat_value',
		'repeat_type',
		'repeat_timestamp',
		'offer_number',
		'additional_technicians',
		'remarks',
		'work_done',
		'delivery_address',
		'contact',
		'case_type',
		'est_hours',
		'est_materials',
		'est_cost_hours',
		'est_cost_materials',
		'department',
		'is_service',
		'no_materials',
		'budget_lock',
		'budget_cost',
		'budget_sale',
		'reviewed_budget_cost',
		'reviewed_budget_sale',
		'budget_hour_cost',
		'budget_hour_sale',
		'reviewed_budget_hour_cost',
		'reviewed_budget_hour_sale',
		'case_number',
		'hmn',
		'sub_number',
		'upper_case',
		'upper_case_number',
		'hmn_report_number',
		'hmn_customer_number',
		'eco_handle',
		'updated_at',
		'created_at',
		'asset_id',
		'service_id',
		'offer_blob_hash',
		'offer_description',
		'offer_ref',
		'offer_rek',
		'offer_remark',
		'is_jublo_case',
		'customer_id',
	];

	public $ourref;
	public $requestor;
	public $creation_date;
	public $error_type;
	public $description;
	public $main_technician;
	public $status;
	public $scanstatus;
	public $made_by;
	public $perform_time_from;
	public $perform_time_to;
	public $repeat;
	public $repeat_value;
	public $repeat_type;
	public $repeat_timestamp;
	public $offer_number;
	public $additional_technicians;
	public $remarks;
	public $work_done;
	public $delivery_address;
	public $contact;
	public $case_type;
	public $est_hours;
	public $est_materials;
	public $est_cost_hours;
	public $est_cost_materials;
	public $department;
	public $is_service;
	public $no_materials;
	public $budget_lock;
	public $budget_cost;
	public $budget_sale;
	public $reviewed_budget_cost;
	public $reviewed_budget_sale;
	public $budget_hour_cost;
	public $budget_hour_sale;
	public $reviewed_budget_hour_cost;
	public $reviewed_budget_hour_sale;
	public $case_number;
	public $hmn;
	public $sub_number;
	public $upper_case;
	public $upper_case_number;
	public $hmn_report_number;
	public $hmn_customer_number;
	public $eco_handle;
	public $updated_at;
	public $created_at;
	public $asset_id;
	public $service_id;
	public $offer_blob_hash;
	public $offer_description;
	public $offer_ref;
	public $offer_rek;
	public $offer_remark;
	public $is_jublo_case;
	public $customer_id;

	/** @var Debtor */
	public $customer;

	protected $casts = [
		'case_number'   => 'int',
		'is_jublo_case' => 'bool',
		'is_service'    => 'bool',
		'updated_at'    => 'datetime',
		'created_at'    => 'datetime'
	];

	public function setCustomerIdAttribute( $id )
	{
		try
		{
			$this->customer = ( new DebtorRequest( $this->client ) )->find( $id );
		} catch ( RequestException $requestException )
		{
			$this->customer = null;
		}

		return $id;
	}

	public function setStatus( int $statusId )
	{
		$this->update([
			'status' => $statusId
		]);

		$this->status = $statusId;

		return $this;
	}
}