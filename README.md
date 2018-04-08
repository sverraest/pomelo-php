# PomeloPHP

[![Build Status](https://travis-ci.org/sverraest/pomelo-php.svg?branch=master)](https://travis-ci.org/sverraest/pomelo-php)
[![codecov](https://codecov.io/gh/sverraest/pomelo-php/branch/master/graph/badge.svg)](https://codecov.io/gh/sverraest/pomelo-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sverraest/pomelo-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sverraest/pomelo-php/?branch=master)
[![Maintainability](https://api.codeclimate.com/v1/badges/ef5f5dd14aeac02f0daf/maintainability)](https://codeclimate.com/github/sverraest/pomelo-php/maintainability)

> PHP API Client and bindings for the Pomelo Pay API

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

