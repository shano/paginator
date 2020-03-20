# Paginator

Pagination library for various list types in PHP.

## Supported List Types

* PHP Arrays
* PHP ArrayObjects
* Illuminate Collections (for Laravel)

## Usage

```php
<?php

use Paginator\Adapters\InputAdapterCollection;
use Paginator\Paginator;

$list = new InputAdapterCollection(
    new \ArrayObject(['alpha', 'beta', 'gamma', 'delta'])
);

$elementsPerPage = 2
$page = 1;

$pagination = (new Paginator($this->input, $elementsPerPage))->paginate($page)->elements());
// Returns \ArrayObject(['gamma', 'delta']));

?>
```

## Installation

Add the repository into your composer.json

```json
"repositories":[
    {
        "type": "vcs",
        "url": "git@github.com:shano/paginator.git"
    }
]
```

Then run to install the package

```bash
composer require shano/paginator
```

## Running Unit Tests

```bash
git clone https://github.com/shano/paginator
cd paginator
composer install --dev
php vendor/bin/phpunit
php vendor/bin/phpunit  --coverage-text
```

## TODOS

* Better exception handling, right now it only exposes the underlying errors rather than errors that maintain the pagination level of abstraction.
* Right now anything requested outside the allowable pagination just returns empty, should that also errors?
* Better structure to unit tests
* How collections are sliced needs improving
