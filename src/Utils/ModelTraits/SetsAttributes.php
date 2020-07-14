<?php

namespace LasseRafn\Ordrestyring\Utils\ModelTraits;


use Illuminate\Support\Str;

trait SetsAttributes
{
    protected $casts = [];

    private function setAttribute($key, $value)
    {
        $key = trim($key);

        $this->{$key} = $this->cast($key, $value);
    }

    private function cast($key, $value)
    {
        $formattedKey = ucfirst(Str::camel($key));

        if (method_exists($this, "set{$formattedKey}Attribute")) {
            return $this->{"set{$formattedKey}Attribute"}($value);
        }

        if ($value === null || !isset($this->casts[$key])) {
            return $value;
        }

        switch ($this->casts[$key]) {
            case 'int':
            case 'integer':
                return (int) $value;

            case 'float':
                return (float) $value;

            case 'date':
                return date('Y-m-d', $value);

            case 'datetime':
                return new \DateTime(date('c', $value));

            case 'double':
            case 'decimal':
                return (float) $value;

            case 'bool':
            case 'boolean':
                return (bool) (is_int($value) ? $value === 1 : $value);

            default:
            case 'string':
                return (string) $value;
        }
    }
}
