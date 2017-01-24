# PHP wrapper for Ordrestyring.dk
Framework agnostic. As it should be.

It's inspired by the Query Builder from Laravel and similar, and uses a nice fluent syntax. Example: 

````php
$ordrestyring->cases()
             ->where('status', 1)
             ->include('hours')
             ->sortDescending()
             ->sortBy('id')
             ->page(4)
             ->perPage(15)
             ->get();
````

This will return a ````Illuminate/Collection```` of cases, with related hours, ordered descending by id, and take 15 results from page 4.

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

...

$ordrestyring = new Ordrestyring('API-KEY');

$ordrestyring->cases()->get();
````