# PHP NOVU SDK

[![Latest Stable Version](https://poser.pugx.org/unicodeveloper/laravel-paystack/v/stable.svg)](https://packagist.org/packages/unicodeveloper/laravel-paystack)
[![License](https://poser.pugx.org/unicodeveloper/laravel-paystack/license.svg)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/unicodeveloper/laravel-paystack.svg)](https://travis-ci.org/unicodeveloper/laravel-paystack)
[![Quality Score](https://img.shields.io/scrutinizer/g/unicodeveloper/laravel-paystack.svg?style=flat-square)](https://scrutinizer-ci.com/g/unicodeveloper/laravel-paystack)
[![Total Downloads](https://img.shields.io/packagist/dt/unicodeveloper/laravel-paystack.svg?style=flat-square)](https://packagist.org/packages/unicodeveloper/laravel-paystack)

> The [PHP Novu](https://novu.co) SDK and package provides a fluent and expressive interface for interacting with Novu's API and managing notifications.

## Installation

[PHP](https://php.net) 7.2+ and [Composer](https://getcomposer.org) are required.


```bash
composer require unicodeveloper/novu
```

## Usage

First, create an instance of the SDK like so:

```bash
use Novu\SDK\Novu;

$novu = new Novu(<INSERT_API_KEY_HERE>);
```

Now, you can use the `Novu` instance to perform all the actions that Novu's API provides. 

### EVENTS

**Trigger** an event - send notification to subscribers:

```php
$response = $novu->triggerEvent([
    'name' => '<REPLACE_WITH_EVENT_NAME_FROM_ADMIN_PANEL>',
    'payload' => ['customVariables' => 'Hello'],
    'to' => [
        'subscriberId' => '<SUBSCRIBER_IDENTIFIER_FROM_ADMIN_PANEL>',
        'phone' => '07983882186'
    ]
])->toArray();

```

**Broadcast** event to all existing subscribers:

```php
$response = $novu->broadcastEvent([
    'name' => '<REPLACE_WITH_EVENT_NAME_FROM_ADMIN_PANEL>',
    'payload' => ['customVariables' => 'Hello'],
    'transactionId' => '<REPLACE_WITH_TRANSACTION_ID>'
])->toArray();
```

**Cancel** triggered event. Using a previously generated transactionId during the event trigger, this action will cancel any active or pending workflows:

```php
$response = $novu->cancelEvent($transactionId)->toArray();
```




**Novu SDK** was created by **[Prosper Otemuyiwa](https://twitter.com/unicodeveloper)** under the **[MIT license](https://opensource.org/licenses/MIT)**.
