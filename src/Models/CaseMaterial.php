<?php

namespace LasseRafn\Ordrestyring\Models;

use LasseRafn\Ordrestyring\Requests\CaseItemRequest;
use LasseRafn\Ordrestyring\Requests\DebtorRequest;
use LasseRafn\Ordrestyring\Utils\Model;
use LasseRafn\Ordrestyring\Utils\ModelTraits\CanUpdate;

class CaseMaterial extends Model
{
    use CanUpdate;

    const ENDPOINT = '/case-materials';
    const PRIMARY_KEY = 'id';
    const REQUEST_CLASS = CaseItemRequest::class;

    public $added_type;
    public $id;
    public $quantity;
    public $ean;
    public $product_number;
    public $product_text;
    public $supplier;
    public $discount;
    public $cost_price;
    public $list_price;
    public $sales_price;
    public $created_by;
    public $edi_invoice_number;
    public $updated_at;
    public $created_at;
    public $case_number;

    protected $casts = [
        'updated_at'    => 'datetime',
        'created_at'    => 'datetime',
    ];
}
