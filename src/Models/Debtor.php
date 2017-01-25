<?php


namespace LasseRafn\Ordrestyring\Models;


use LasseRafn\Ordrestyring\Utils\Model;

class Debtor extends Model
{
	const ENDPOINT    = '/debtors';
	const PRIMARY_KEY = 'customer_number';
}