# PomeloPHP

[![Build Status](https://travis-ci.org/sverraest/pomelo-php.svg?branch=master)](https://travis-ci.org/sverraest/pomelo-php)
[![codecov](https://codecov.io/gh/sverraest/pomelo-php/branch/master/graph/badge.svg)](https://codecov.io/gh/sverraest/pomelo-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sverraest/pomelo-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sverraest/pomelo-php/?branch=master)
[![Maintainability](https://api.codeclimate.com/v1/badges/ef5f5dd14aeac02f0daf/maintainability)](https://codeclimate.com/github/sverraest/pomelo-php/maintainability)
[![Latest Stable Version](https://poser.pugx.org/sverraest/pomelo-php/v/stable)](https://packagist.org/packages/sverraest/pomelo-php)
[![License](https://poser.pugx.org/sverraest/pomelo-php/license)](https://packagist.org/packages/sverraest/pomelo-php)
[![composer.lock](https://poser.pugx.org/sverraest/pomelo-php/composerlock)](https://packagist.org/packages/sverraest/pomelo-php)

> PHP API Client and bindings for the [Pomelo Pay API](https://github.com/PomeloPay/pomelo-apidoc)

Using this PHP API Client you can interact with your Pomelo Pay:
- 💳 __Transactions__

## Installation

Requires PHP 7.0 or higher

The recommended way to install pomelo-php is through [Composer](https://getcomposer.org):

First, install Composer:

```
$ curl -sS https://getcomposer.org/installer | php
```

Next, install the latest pomelo-php:

```
$ php composer.phar require sverraest/pomelo-php
```

Finally, you need to require the library in your PHP application:

```php
require "vendor/autoload.php";
```

## Development

- Run `composer test` and `composer phpcs` before creating a PR to detect any obvious issues.
- Please create issues for this specific API Binding under the [issues](https://github.com/sverraest/revolut-php/issues) section.
- [Contact Pomelo Pay](https://www.pomelopay.com) directly for Pomelo Pay API support.


## Quick Start
### PomeloPHP\Client
First get your `production` or `sandbox` API key from [Pomelo Pay](https://app.pomelopay.com/dashboard/apps).

If you want to get a `production` client:

```php
use PomeloPHP\Client;

$client = new Client('apikey', 'appid');
```

If you want to get a `sandbox` client:

```php
use PomeloPHP\Client;

$client = new Client('apikey', 'appid', 'sandbox');
```

If you want to pass additional [GuzzleHTTP](https://github.com/guzzle/guzzle) options:

```php
use PomeloPHP\Client;

$options = ['headers' => ['foo' => 'bar']];
$client = new Client('apikey', 'appid', 'sandbox', $options);
```

## Available API Operations

The following exposed API operations from the Pomelo Pay API are available using the API Client.

See below for more details about each resource.

💳 __Transactions__

Get all transactions, get information about a specific transaction, create a new transaction.

## Usage details

### 💳 Transactions
#### Get all transactions

```php
use PomeloPHP\Client;

$client = new Client('apikey', 'appid');
$transactions = $client->transactions->all();
```
#### Get one transaction

```php
use PomeloPHP\Client;

$client = new Client('apikey', 'appid');
$transaction = $client->transactions->get('foo');
```

#### Create transaction

```php
use PomeloPHP\Client;

$client = new Client('apikey', 'appid');

$json = [
 "provider" => "POMELO", // Provider enabled for your merchant account such as POMELO, BANCONTACT, ALIPAY, etc...
 "currency" => "GBP",
 "amount" => 1000, // 10.00 GBP
 "redirectUrl" => "https://foo.bar/order/123" // Optional redirect after payment completion
];

$transaction = $client->transactions->create($json);
header('Location: '. $transaction["forwardUrl"]); // Go to transaction payment page
```
### Pagination

The Pomelo Pay API offers a flexible pagination structure for GET requests on collections.
The following query filters are possible for pagination.
The default page number is 1.



| Query                     | Values                                                               |
| --------------------------|----------------------------------------------------------------------| 
| pagination                | 0 or 1 (disabled pagination, is enabled by default)                  |
| page                      | 1,2,3,4,... (page of the collection, default is 1)                   |
| itemsPerPage              | 20 (numbers of items per page, default is 20)                        |

```php
use PomeloPHP\Client;

$client = new Client('apikey', 'appid');

$subSet = $client->transactions->all([
  "page" => 3,  // We're on page 3
  "itemsPerPage" => 5 // We're displaying 5 items per page
]);

$all = $client->transactions->all([
  "pagination" => 0 // Don't paginate the results
]); 
```

## About

➡️ You can follow me on 🐦 [Twitter](https://www.twitter.com/simondoestech) or ✉️ email me at simon[-at-]pomelopay.com.

⭐ Sign up as a merchant at https://pomelopay.com and start receiving payments in seconds.
