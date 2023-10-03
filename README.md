<div align="center">
  <a href="https://novu.co" target="_blank">
  <picture>
    <source media="(prefers-color-scheme: dark)" srcset="https://user-images.githubusercontent.com/2233092/213641039-220ac15f-f367-4d13-9eaf-56e79433b8c1.png">
    <img src="https://user-images.githubusercontent.com/2233092/213641043-3bbb3f21-3c53-4e67-afe5-755aeb222159.png" width="280" alt="Logo"/>
  </picture>
  </a>
</div>

# PHP SDK

[![Latest Stable Version](https://poser.pugx.org/unicodeveloper/novu/v/stable.svg)](https://packagist.org/packages/unicodeveloper/novu)
[![License](https://poser.pugx.org/unicodeveloper/novu/license.svg)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/unicodeveloper/novu.svg)](https://packagist.org/packages/unicodeveloper/novu)

> The [PHP Novu](https://novu.co) SDK and package provides a fluent and expressive interface for interacting with Novu's API and managing notifications.

## Installation

[PHP](https://php.net) 7.2+ and [Composer](https://getcomposer.org) are required.

To get the latest version of Novu PHP SDK, simply require it:

```bash
composer require unicodeveloper/novu
```

## Contents

* [Installation](#installation)
* [Usage](#usage)
    * [Novu API Reference](https://docs.novu.co/api-reference/)
    * [Events](#events)
    * [Subscribers](#subscribers)
    * [Topics](#topics)
    * [Activity](#activity)
    * [Integrations](#integrations)
    * [Notifications](#notifications)
    * [Notification Templates](#notification-templates)
    * [Notification Groups](#notification-groups)
    * [Changes](#changes)
    * [Environments](#environments)
    * [Feeds](#feeds)
    * [Messages](#messages)
    * [Execution Details](#execution-details)
    * [Validate the MX Record setup for Inbound Parse functionality](#validate-the-mx-record-setup-for-inbound-parse-functionality)
* [License](#license)

## Usage

To interact with the **Novu SDK**, you can instantiate it with either just an API key or with a configuration array that includes the API key and a custom base URI.

### Using just the API key:

```php
use Novu\SDK\Novu;

$novu = new Novu('YOUR_API_KEY_HERE');

// Sign up on https://web.novu.co and grab your API key from https://web.novu.co/settings
```

### Using a configuration array:

If you need to specify a custom base URI (e.g., if you are pointing to a staging environment or a local development setup), you can pass an array with the `apiKey` and `baseUri`:

```php
use Novu\SDK\Novu;

$config = [
    'apiKey' => 'YOUR_API_KEY_HERE',
    'baseUri' => 'https://custom-api-url.com/v1/'
];

$novu = new Novu($config);

// Get started with self-hosted Novu here https://docs.novu.co/overview/docker-deploy
```

Once the `Novu` instance is created, you can use it to perform all the actions that Novu's API provides.


## EVENTS

**Trigger** an event - send notification to subscribers:

```php
$response = $novu->triggerEvent([
    'name' => '<REPLACE_WITH_TEMPLATE_NAME_FROM_ADMIN_PANEL>',
    'payload' => ['customVariables' => 'Hello'],
    'to' => [
        'subscriberId' => '<SUBSCRIBER_IDENTIFIER_FROM_ADMIN_PANEL>',
        'phone' => '07983882186'
    ]
])->toArray();
```

**Bulk Trigger** events:

```php
$response = $novu->bulkTriggerEvent([
    [
        'name' => '<REPLACE_WITH_TEMPLATE_NAME_FROM_ADMIN_PANEL>', 
        'to' => '<SUBSCRIBER_IDENTIFIER_FROM_ADMIN_PANEL>', 
        'payload' => ['customVariables' => 'Hello']
    ],
    [
        'name' => '<REPLACE_WITH_TEMPLATE_NAME_FROM_ADMIN_PANEL>', 
        'to' => '<SUBSCRIBER_IDENTIFIER_FROM_ADMIN_PANEL>', 
        'payload' => ['customVariables' => 'World']
    ],
    [
        'name' => '<REPLACE_WITH_TEMPLATE_NAME_FROM_ADMIN_PANEL>', 
        'to' => '<SUBSCRIBER_IDENTIFIER_FROM_ADMIN_PANEL>', 
        'payload' => ['customVariables' => 'Again']
    ]
])->toArray();
```

**Trigger** an event - [send notification to topics](https://docs.novu.co/platform/topics#sending-a-notification-to-a-topic)

```php
$response = $novu->triggerEvent([
    'name' => '<event_name>',
    'payload' => ['customVariables' => 'Hello'],
    'to' => [
        [
            'type' => 'Topic',
            'topicKey' => $topicKey
        ],
        [
            'type' => 'Topic',
            'topicKey' => $topicSecondKey
        ]
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
$response = $novu->cancelEvent($transactionId);
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

// Bulk create subscribers
$response = $novu->bulkCreateSubscribers([
    [
        'subscriberId' => 'SUBSCRIBER_IDENTIFIER>',
        'email' => '<insert-email>', // optional
        'firstName' => '<insert-firstname>', // optional
        'lastName' => '<insert-lastname>', // optional
        'avatar' => '<insert-avatar>', // optional
    ],
    [
        'subscriberId' => 'SUBSCRIBER_IDENTIFIER>',
        'email' => '<insert-email>', // optional
        'firstName' => '<insert-firstname>', // optional
        'lastName' => '<insert-lastname>', // optional
        'avatar' => '<insert-avatar>', // optional
    ],
]);

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
$response = $novu->updateSubscriberCredentials($subscriberId, [
    'providerId'  => '<insert-providerId>',
    'credentials' => '<insert-credentials>'
])->toArray();

// Update subscriber online status
$isOnlineStatus = true; // or false
$response = $novu->updateSubscriberOnlineStatus($subscriberId, $isOnlineStatus)->toArray();

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

## TOPICS

```php

// Create a Topic
$novu->createTopic([
  'key'  => 'frontend-users',
  'name' => 'All frontend users'
]);

// Fetch all topics
$novu->getTopics();

// Get a topic
$novu->topic($topicKey);

// Add subscribers to a topic
$subscribers = [
    '63e271488c028c44fd3a64e7',
    '3445'
];
$novu->topic($topicKey)->addSubscribers($subscribers);

// Remove subscribers from a topic
$subscribers = [
    '63e271488c028c44fd3a64e7',
    '3445'
];
$novu->topic($topicKey)->removeSubscribers($subscribers);

// Rename a topic
$novu->topic($topicKey)->rename($topicName);

```

## ACTIVITY

```php

// Get activity feed
$feed = $novu->getActivityFeed();

// Get activity statistics
$stats = $novu->getActivityStatistics()->toArray();

// Get activity graph statistics
$graphStats = $novu->getActivityGraphStatistics()->toArray();

```

## INTEGRATIONS

```php

// Get integrations
$novu->getIntegrations()->toArray();

// Create integration
$novu->createIntegration([
    'providerId' => '<insert->provider->id>',
    'channel' => '<insert->channel>',
    'credentials' => [
        // insert all the fields
    ],
    'active' => true,
    'check' => true
])->toArray();

// Get active integrations
$novu->getActiveIntegrations()->toArray();

// Get webhook support status for provider
$novu->getWebhookSupportStatusForProvider($providerId)->toArray();

// Update integration
$novu->updateIntegration($integrationId, [
    'active' => true,
    'credentials' => [
        // insert all the fields
    ],
    'check' => true
])->toArray();

// Delete integration
$novu->deleteIntegration($integrationId);

```

## NOTIFICATIONS

```php

// Get all notifications
$novu->getNotifications()->toArray();

// Get all notifications with query parameters
$queryParams = [
    'page' => 3
];
$novu->getNotifications($queryParams)->toArray();

// Get one notification 
$novu->getNotification($notificationId)->toArray();

// Get notification stats
$novu->getNotificationStats()->toArray();

// Get Notification graph stats
$novu->getNotificationGraphStats()->toArray();

// Get Notification graph stats with query parameters
$queryParams = [
    'days' => 5
];
$novu->getNotificationGraphStats($queryParams)->toArray();

```

## NOTIFICATION TEMPLATES

```php

// Get notification templates
$novu->getNotificationTemplates()->toArray();

// Create notification template
$novu->createNotificationTemplate([
  "name" => "name",
  "notificationGroupId" => "notificationGroupId",
  "tags" => ["tags"],
  "description" => "description",
  "steps" => ["steps"],
  "active" => true,
  "draft" => true,
  "critical" => true,
  "preferenceSettings" => preferenceSettings
])->toArray();

// Update notification template
$novu->updateNotificationTemplate($templateId, [
  "name" => "name",
  "tags" => ["tags"],
  "description" => "description",
  "identifier" => "identifier",
  "steps" => ["steps"],
  "notificationGroupId" => "notificationGroupId",
  "active" => true,
  "critical" => true,
  "preferenceSettings" => preferenceSettings
])->toArray();

// Delete notification template
$novu->deleteNotificationTemplate($templateId);

// Get notification template
$novu->getANotificationTemplate($templateId);

// Update notification template status
$novu->updateNotificationTemplateStatus($templateId, [
    'active' => true
])

```

## NOTIFICATION GROUPS

```php

// Create Notification group
$novu->createNotificationGroup([
    'name' => '<insert-name>'
]);

// Get Notification groups
$novu->getNotificationGroups()->toArray();

```
## CHANGES

```php

// Get changes
$novu->getChanges();

// Get changes count
$novu->getChangesCount()->toArray();

// Apply changes
$novu->applyBulkChanges([
    'changeIds' = [
        '<insert-all-the-change-ids>'
    ]
])->toArray();

// Apply change
$novu->applyChange($changeId, []);

```

## ENVIRONMENTS

```php

// Get current environment
$novu->getCurrentEnvironment()->toArray();

// Create environment
$novu->createEnvironment([
    'name' => '<insert-name>',
    'parentId' => '<insert-parent-id>' // optional
])->toArray();

// Get environments
$novu->getEnvironments()->toArray();

// Update environment by id
$novu->updateEnvironment($envId, [
  "name" => "name",
  "identifier" => "identifier",
  "parentId" => "parentId"
]);

// Get API KEYS
$novu->getEnvironmentsAPIKeys()->toArray();

// Regenerate API KEYS
$key = $novu->regenerateEnvironmentsAPIKeys()->toArray();

// Update Widget Settings
$novu->updateWidgetSettings([
    'notificationCenterEncryption' => true
]);

```

## FEEDS

```php

// Create feed
$novu->createFeed([
    'name' => '<insert-name-for-feed>'
]);

// Get feeds
$novu->getFeeds()->toArray();

// Delete feed
$novu->deleteFeed();

```

## MESSAGES

```php

// Get messages
$novu->getMessages();

// Delete message
$novu->deleteMessage();

```

## EXECUTION DETAILS

```php

// Get execution details
$novu->getExecutionDetails([
    'notificationId' => '<insert-notification-id>',
    'subscriberId'   => '<insert-subscriber-id>'
])->toArray();

```

## Validate the MX Record setup for Inbound Parse functionality

```php

// Validate MX Record for Inbound Parse
$novu->validateMXRecordForInboundParse()->toArray();

```

## License

**Novu PHP SDK** was created by **[Prosper Otemuyiwa](https://twitter.com/unicodeveloper)** under the **[MIT license](https://opensource.org/licenses/MIT)**.
