<?php

namespace LasseRafn\Ordrestyring\Requests;

use GuzzleHttp\Client;
use LasseRafn\Ordrestyring\Models\InternalGood;
use LasseRafn\Ordrestyring\Utils\Request;
use LasseRafn\Ordrestyring\Utils\RequestExtensions\CanCreate;
use LasseRafn\Ordrestyring\Utils\RequestExtensions\CanUpdate;

class InternalGoodRequest extends Request
{
    use CanUpdate, CanCreate;

    protected $modelClass = InternalGood::class;

    public function __construct(Client $client)
    {
        $this->endpoint = InternalGood::ENDPOINT;
        $this->primaryKey = InternalGood::PRIMARY_KEY;

        parent::__construct($client);
    }
}
