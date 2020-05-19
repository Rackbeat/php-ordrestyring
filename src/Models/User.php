<?php

namespace LasseRafn\Ordrestyring\Models;

use LasseRafn\Ordrestyring\Requests\DebtorRequest;
use LasseRafn\Ordrestyring\Utils\Model;

class User extends Model
{
    const ENDPOINT = '/users';
    const PRIMARY_KEY = 'id';
    const REQUEST_CLASS = DebtorRequest::class;

    public $init;
    public $last_name;
    public $tlf;
    public $mobil_privat;
    public $first_name;
    public $id;
    public $status;
    public $email;
    public $department_id;
    public $employee_type_id;
    public $fullName;

    protected $casts = [
	    'id' => 'int',
        'status' => 'int',
        'department_id' => 'int',
        'employee_type_id' => 'int',
    ];
}
