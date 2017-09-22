<?php

namespace LasseRafn\Ordrestyring\Utils\RequestExtensions;

trait CanCreate
{
    public function create($data)
    {
        $response = $this->getResponse(function () use ($data) {
            return $this->client->post("{$this->endpoint}", [
                'json' => $data,
            ]);
        });
    }
}
