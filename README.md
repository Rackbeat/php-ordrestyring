# PHP wrapper for Ordrestyring.dk

REST Api Wrapper for [Ordrestyring v2 API](http://api.ordrestyring.dk). 

<p align="center"> 
<a href="https://travis-ci.org/LasseRafn/php-ordrestyring"><img src="https://img.shields.io/travis/LasseRafn/php-ordrestyring.svg?style=flat-square" alt="Build Status"></a>
<a href="https://coveralls.io/github/LasseRafn/php-ordrestyring"><img src="https://img.shields.io/coveralls/LasseRafn/php-ordrestyring.svg?style=flat-square" alt="Coverage"></a>
<a href="https://styleci.io/repos/78973710"><img src="https://styleci.io/repos/78973710/shield?branch=master" alt="StyleCI Status"></a>
<a href="https://packagist.org/packages/LasseRafn/php-ordrestyring"><img src="https://img.shields.io/packagist/dt/LasseRafn/php-ordrestyring.svg?style=flat-square" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/LasseRafn/php-ordrestyring"><img src="https://img.shields.io/packagist/v/LasseRafn/php-ordrestyring.svg?style=flat-square" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/LasseRafn/php-ordrestyring"><img src="https://img.shields.io/packagist/l/LasseRafn/php-ordrestyring.svg?style=flat-square" alt="License"></a>
</p>

It's inspired by the Query Builder from Laravel and similar, and uses a nice fluent syntax. Example: 

````php
$ordrestyring->cases()
             ->with('hours', 'type')
             ->where('status', 1)
             ->sortDescending()
             ->sortBy('id')
             ->perPage(15)
             ->page(4)
             ->get();
````

This will return a ``Illuminate/Collection`` of cases, with related hours and type, ordered descending by id, and take 15 results from page 4.

You can also do things like:
````php
$ordrestyring->users()->find(10);
````

````php
$ordrestyring->debtors()->first();
````

````php
$ordrestyring->departments()->where('number', '!=', 19)->all();
````

````php
$ordrestyring->debtors()->where('id', [1,2,3,4])->get(); // Will get debtors with id 1, 2, 3 and/or 4
````

# Installation
````bash
composer require lasserafn/php-ordrestyring
````

# Usage
````php
$ordrestyring = new LasseRafn\Ordrestyring\Ordrestyring('API-KEY');

$ordrestyring->cases()->get();
````

You'd probably want to add a use statement instead:
````php
use LasseRafn\Ordrestyring\Ordrestyring;
````

## Exceptions
All request exceptions will throw an exception, which extends ``GuzzleHttp\Exception\ClientException``. The returned exception is ``LasseRafn\Ordrestyring\Exceptions\RequestException`` and will get the error message from Ordrestyring if one is present, and default to the ClientException message if none is present. So handling exceptions can be as simple as:

````php
try {
    // try to get something from the api, but nothing is found.
}
catch( LasseRafn\Ordrestyring\Exceptions\RequestException $exception ) {
    echo $exception->message; // could redirect back with the message.
}
````

Would echo out something like: "This item does not exists" (according to their API)