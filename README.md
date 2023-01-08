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

First, create an instance of the **Novu SDK** like so:

```php
use Novu\SDK\Novu;

$novu = new Novu(<INSERT_API_KEY_HERE>);
```

Now, you can use the `Novu` instance to perform all the actions that Novu's API provides. 

## EVENTS

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

## SUBSCRIBERS

```php

// Get list of subscribers
$subscribers  = $novu->getSubscriberList();

// Create subscriber & get the details of the recently created subscriber returned.
$subscriber = $novu->createSubscriber([
    'subscriberId' => 'YOUR_SYSTEM_USER_ID>',
    'email' => '<insert-email>', // optional
    'firstName' => '<insert-firstname>', // optional
    'lastName' => '<insert-lastname>', // optional
    'phone' => '<insert-phone>', //optional
    'avatar' => '<insert-avatar>', // optional
])->toArray();

// Get subscriber
$subscriber = $novu->getSubscriber($subscriberId)->toArray();

// Update subscriber
$subscriber = $novu->updateSubscriber($subscriberId, [
    'email' => '<insert-email>', // optional
    'firstName' => '<insert-firstname>', // optional
    'lastName' => '<insert-lastname>', // optional
    'phone' => '<insert-phone>', //optional
    'avatar' => '<insert-avatar>', // optional
])->toArray();

// Delete subscriber
$novu->deleteSubscriber($subscriberId);

// Update subscriber credentials
$response => $novu->updateSubscriberCredentials($subscriberId, [
    'providerId'  => '<insert-providerId>',
    'credentials' => '<insert-credentials>'
])->toArray();

// Get subscriber preferences
$preferences = $novu->getSubscriberPreferences($subscriberId)->toArray();

// Update subscriber preference
$novu->updateSubscriberPreference($subscriberId, $templateId, [
    'channel' => 'insert-channel',
    'enabled' => 'insert-boolean-value' // optional
]);

// Get a notification feed for a particular subscriber
$feed = $novu->getNotificationFeedForSubscriber($subscriberId);

// Get the unseen notification count for subscribers feed
$count = $novu->getUnseenNotificationCountForSubscriber($subscriberId);

// Mark a subscriber feed message as seen
$novu->markSubscriberFeedMessageAsSeen($subscriberId, $messageId, []);

// Mark message action as seen
$novu->markSubscriberMessageActionAsSeen($subscriberId, $messageId, $type, []);

```


**Novu SDK** was created by **[Prosper Otemuyiwa](https://twitter.com/unicodeveloper)** under the **[MIT license](https://opensource.org/licenses/MIT)**.
