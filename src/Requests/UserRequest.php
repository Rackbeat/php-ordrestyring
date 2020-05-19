<?php

namespace LasseRafn\Ordrestyring\Requests;

use GuzzleHttp\Client;
use LasseRafn\Ordrestyring\Models\Debtor;
use LasseRafn\Ordrestyring\Models\User;
use LasseRafn\Ordrestyring\Utils\Request;
use LasseRafn\Ordrestyring\Utils\RequestExtensions\CanCreate;
use LasseRafn\Ordrestyring\Utils\RequestExtensions\CanUpdate;

class UserRequest extends Request
{
    use CanUpdate, CanCreate;

    protected $modelClass = Debtor::class;

    public function __construct(Client $client)
    {
        $this->endpoint = User::ENDPOINT;
        $this->primaryKey = User::PRIMARY_KEY;

        parent::__construct($client);
    }
}
