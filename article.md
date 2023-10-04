With its comprehensive and easy to use tools or library it help a developer who uses PHP,
in building rapid notification layer without re-inventing the wheel.

Here are the overview of Novu PHP SDK ,
its key features  and how it can benefit  Developers in their  projects


The  first question that comes to our mind is what's Novu PHP SDK ?

To answer this question we must first Describe what an SDK is .
As the name implies it a software  development kit  which entails that its a set of tools used by  software developers for a specific Development environment .
    Its more like a software that packages a every individual tool needed for running a specific software in a single box .

    Novu PHP Sdk  can be defined as a php library that enable the easy or detailed protocol or interface for integrating Novu Api and handling its Notification.
 I simply make the integration of Novu API effortless for php developers .

Novu Php sdk is still in its version 1.0.6  which is suitable  for PHP7.2 and above .

            things you can do with  NovuPHpSdk
* send  notification to subscribers, bulk notification, topic notification , broadcast event to existing subscribers .
*notification on feeds, messages


With this features you can send many notification with a single API , for different packages .

Installation of NovuPHPSdk  in your projects .
1. composer require unicodeveloper/novu.
2. sign-up on http://web.novu.co.
3.click the setting button .
4.copy the API key .
5. create a file with PHP extension  “example.php”.
6. insert the following code .
require(render/autoload.php);
use Novu\SDk\Novu;
$apiKey = “<Api_key>”;
$novu  = new Novu($apikey);
you can now build your amazing Notification API.

Novu Php Sdk is an Open source project created by Prosper Otemuyiwa.
