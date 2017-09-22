<?php

namespace LasseRafn\Ordrestyring\Requests;

use GuzzleHttp\Client;
use LasseRafn\Ordrestyring\Models\CaseItem;
use LasseRafn\Ordrestyring\Utils\Request;
use LasseRafn\Ordrestyring\Utils\RequestExtensions\CanCreate;
use LasseRafn\Ordrestyring\Utils\RequestExtensions\CanUpdate;

class CaseItemRequest extends Request
{
    use CanUpdate, CanCreate;

    protected $modelClass = CaseItem::class;

    public function __construct(Client $client)
    {
        $this->endpoint = CaseItem::ENDPOINT;
        $this->primaryKey = CaseItem::PRIMARY_KEY;

        parent::__construct($client);
    }
}
