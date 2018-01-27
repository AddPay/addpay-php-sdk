<p align="center">
    <img src="https://www.addpay.co.za/app/assets/img/addpay/addpay_logo.png"/><br/>
</p>
<p align="center">
    <strong>AddPay PHP SDK</strong> by <a href="https://github.com/stephenlake">Stephen Lake</a><br/>
    A PHP package to assist in developing applications communicating with the AddPay API.
</p>
<p align="center">
    <img src="https://img.shields.io/badge/build-stable-brightgreen.svg?style=flat"/>
    <img src="https://img.shields.io/badge/tests-passing-brightgreen.svg?style=flat"/>
    <img src="https://img.shields.io/badge/coverage-100%25-brightgreen.svg?style=flat"/>
    <img src="https://img.shields.io/badge/maintainability-A++-brightgreen.svg?style=flat"/>
    <img src="https://img.shields.io/badge/php-%3E=5.3-brightgreen.svg?style=flat"/>
    <img src="https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat"/>
</p>

## Documentation
- [Getting Started](https://github.com/stephenlake/AddPay-PHP-SDK#getting-started)
  - [Requirements](https://github.com/stephenlake/AddPay-PHP-SDK#requirements)
  - [Running the Examples](https://github.com/stephenlake/AddPay-PHP-SDK#runningusing-examples) :warning: Step-by-Step with animated GIF's
  - [Download Latest Release](https://github.com/stephenlake/AddPay-PHP-SDK#download-latest-release)
  - [Configuration](https://github.com/stephenlake/AddPay-PHP-SDK#configuration)
  - [Before Diving Into Code](https://github.com/stephenlake/AddPay-PHP-SDK#before-diving-into-code) :warning: Big Time Saver
  - [SDK Repository Reference](https://github.com/stephenlake/AddPay-PHP-SDK#sdk-repository-reference)
  - [SDK Methods Reference](https://github.com/stephenlake/AddPay-PHP-SDK#sdk-method-reference)
- [Bug Reporting](https://github.com/stephenlake/AddPay-PHP-SDK#bug-reporting)
- [Contributing & Suggestions](https://github.com/stephenlake/AddPay-PHP-SDK#contributing-and-suggestions)
- [Disclaimer](https://github.com/stephenlake/AddPay-PHP-SDK#disclaimer)

## Getting Started
Please have the [AddPay API Documentation](https://www.addpay.co.za/developers) open and closeby when referencing fields, this will improve your productivity and hopefully answer many questions you may have on field definitions and requirements. All fields are described within the [AddPay API Documentation](https://www.addpay.co.za/developers).

Requirements
---------
For clarification sake to less experienced developers, this package does NOT require composer - it was merely **built** using composer, do not let the additional files scare you off, the package is dead simple to use. The only requirements are:
- PHP5.3+ (PHP7.1+ Recommended)
- PHP-CURL Extension
- PHP-OPENSSL Extension
- A little bit of patience (Reading Highly Recommended)

Running/Using Examples
---------
The following guides assume you have PHP installed on the system running the code. If PHP is not installed, please view the [PHP Installation documentation](http://php.net/manual/en/install.php). **PHP5.3+ is supported, but PHP7.1+ is recommended for optimal performance**.

* <img src="https://dotnetco.de/wp-content/uploads/2016/12/windows-icon256.png" width="24"> [Getting Started: Windows](https://github.com/stephenlake/AddPay-PHP-SDK/wiki/Getting-Started:-Windows) (Animated GIF's Included)
* <img src="http://icons.iconarchive.com/icons/icons8/windows-8/256/Systems-Linux-icon.png" width="24"> [Getting Started: Linux/Mac](https://github.com/stephenlake/AddPay-PHP-SDK/wiki/Getting-Started:-Linux-&-Mac) (Animated GIF's Included)

**More Advanced Developers**

Developers using composer and/or developers who prefer OOP code can simply import the required services from the `AddPay\Foundation\Protocol\API` namespace and use the package you would any other:
```php
<?php

use AddPay\Foundation\Protocol\API\OpenAPI;
use AddPay\Foundation\Protocol\API\PublicAPI;
use AddPay\Foundation\Protocol\API\PrivateAPI;

$openAPI = new OpenAPI();
$pubAPI  = new PublicAPI();
$pvtAPI  = new PrivateAPI();

// Quick start example:
$openAPI->transactions()->find('SOME_TRANSACTION_ID_HERE');

// If you wish to load a config file from a custom directory,
// copy the config/config.json to the directory of your choice
// and pass through the DIRECTORY as an argument in the instantiation
//
// Note: The file name must be config.json and the argument must be the 
// DIRECTORY excluding the file name

$openAPI = new OpenAPI('path/to/your/config/');
$pubAPI  = new PublicAPI('path/to/your/config/');
$pvtAPI  = new PrivateAPI('path/to/your/config/');
```

Download Latest Release
---------
More advanced users or users that are familiar with composer may download the package through composer if they wish:
```bash
composer require stephenlake/addpay-php-sdk
```

Alternatively, download the master archive directly:
[AddPay-PHP-SDK-Master.zip](https://github.com/stephenlake/AddPay-PHP-SDK/archive/master.zip)

Configuration
---------
- Head to your developer portal or merchant console developer settings if your integration is live, find the section providing your `client_id` and `client_secret`, keep these credentials closeby.
- Open the configuration file in this package located at `path/to/this/package/config/config.json`
- Replace `your_client_id` with your actual `client_id`
- Replace `your_client_secret` with your actual `client_secret`
- If your integration is live, set `live` to `true`
- It is important to ensure the structure of the file is unchanged, the quotes are important!

Before Diving Into Code
---------
#### Helpers
A number of helper functions are imported from within the package as well as third-party packages. The most commonly used method from these imports is `dd()` which is an intelligent function that will smartly print output in a CLI and pretty print it in browser output so that you can read output quickly and easily. If you prefer not using the `dd()` function, simply remove it and replace it with something of your choice. **It is important to note that `dd()` is only used for testing and debugging when examining output data, _do not use `dd()` in production_.**

#### Magic Getter: `get`
The `get()` function is my own custom magic method that allows you to call *any* string after the word 'get' and it will return the value of the string provided within the object it is being called on, this means that even if there are changes to an object, the magic method can still retrieve the added fields without any changes to this SDK.

Example: `$call->getFirstname('John')`

The `getFirstname()` function does not exist, but will succeed and will return the value of `firstname` if it the field `firstname` exists in the data object it is being called on. For nested attributes, the call is simply camel-cased, for example: `$call->getCurrencyName()` will look for the following object:
```json
{
 "currency": {
   "name": "South African Rand"
 }
}
```
If it does not find the attribute, it returns null. The level of nesting using camel-casing is infinite, for example calling `getFooBarsRealLastNameAndLoremIpsum()` will also return a value if the nested attributes exist, otherwise it will return null.

#### Magic Setter: `with`
The magic `with` setter is my own custom magic method that allows you to set *any* string after the word 'with' and it will set the value of the string provided within the object it is being called on. This works in exactly the same way as the magic getter except it **sets** field and nested field values and returns the object so that you can chain setters, for example:

```php
$object->withFirstname('John')
       ->withLastname('Doe')
       ->withAddressStreet('1337 Awesome Street')
       ->withAddressPostal('123456');
```
This wil result in the following object being built:
```json
{
  "firstname": "John",
  "lastname": "Doe",
  "address": {
    "street": "1337 Awesome Street",
    "postal": "123456"
  }
}
```
**Please note** that there are some fallback methods in place to prevent unexpected results, for example, with the above information in mind, you'd expect `withAmountCurrencyCode('USD')` to set the following object:
```json
{
   "amount": {
     "currency": {
        "code": "USD"
     }
   }
}
```
**However**, the AddPay API expects the request payload of a currency code to be a single field of `currency_code` and not an object - therefore a primary function has been defined specifically for `setAmountCurrencyCode()` to prevent such scenarios. You can view the full list of primary defined functions as well as how the magic methods functions were written within the [JSONObject](https://github.com/stephenlake/AddPay-PHP-SDK/blob/master/core/Foundation/Objects/JSONObject.php) class.

SDK Repository Reference
---------
<table>
    <thead>
        <tr>
            <th>API</th>
            <th>Repository</th>
            <th>Invoke Method</th>
            <th>Definition</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>OpenAPI</td>
            <td>Transactions</td>
            <td>transactions()</td>
            <td>Instantiates a transaction repository to call referenced methods.</td>
        </tr>
        <tr>
            <td>OpenAPI</td>
            <td>Services</td>
            <td>services()</td>
            <td>Instantiates a service repository to call referenced methods.</td>
        </tr>
        <tr>
            <td>PrivateAPI</td>
            <td>Authentication</td>
            <td>authentication()</td>
            <td>Instantiates an authentication repository to call referenced methods.</td>
        </tr>
    </tbody>
</table>

SDK Method Reference
---------
<table>
    <thead>
        <tr>
            <th>Method</th>
            <th>Invokable Repository</th>
            <th>Definition</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>instantiate()</td>
            <td>ANY</td>
            <td>Instantiates and returns a new repository JSONObject.</td>
        </tr>
        <tr>
            <td>all()</td>
            <td>ANY</td>
            <td>Returns the entire transaction object.</td>
        </tr>
        <tr>
            <td>get*()</td>
            <td>ANY</td>
            <td>Magic method that returns single-field and nested field objects based on anything placed after the word 'get'. Example: getAmountCurrency() will return the currency object from the amount object of the full resource object.</td>
        </tr>
        <tr>
            <td>with*(mixed)</td>
            <td>ANY</td>
            <td>Magic method that sets single-field and nested field objects based on anything placed after the word 'with'. Example: withAmountValue('1.50') will set value field inside an amount object to '1.50'.</td>
        </tr>
        <tr>
            <td>gotExpectedResult()</td>
            <td>ANY</td>
            <td>Returns true if the response payload meta status code is in the 200 range otherwise returns false.</td>
        </tr>
        <tr>
            <td>succeeds()</td>
            <td>ANY</td>
            <td>Alias of gotExpectedResult().</td>
        </tr>
        <tr>
            <td>fails()</td>
            <td>ANY</td>
            <td>Reversed alias of success().</td>
        </tr>
        <tr>
            <td>getErrorCode()</td>
            <td>ANY</td>
            <td>Returns the meta status error code if an error exists.</td>
        </tr>
        <tr>
            <td>getErrorMessage()</td>
            <td>ANY</td>
            <td>Returns the meta status error message if an error exists.</td>
        </tr>
        <tr>
            <td>get()</td>
            <td>Services</td>
            <td>Submits a request to the API to retrieve a list of objects based on the invoked repository.</td>
        </tr>
        <tr>
            <td>find()</td>
            <td>Transactions</td>
            <td>Submits a request to the API to retrieve an object by ID based on the invoked repository.</td>
        </tr>
        <tr>
            <td>update()</td>
            <td>Transactions</td>
            <td>Submits a request to the API to update an object based on the invoked repository and setters used.</td>
        </tr>
        <tr>
            <td>process()</td>
            <td>Transactions</td>
            <td>Submits a request to the API to process an object by ID based on the invoked repository.</td>
        </tr>
        <tr>
            <td>cancel()</td>
            <td>Transactions</td>
            <td>Submits a request to the API to cancel an object by ID based on the invoked repository.</td>
        </tr>
        <tr>
            <td>store()</td>
            <td>Transactions</td>
            <td>Submits a request to the API to create an object based on the invoked repository and setters used.</td>
        </tr>
        <tr>
            <td>create()</td>
            <td>Transactions</td>
            <td>Alias of store().</td>
        </tr>
        <tr>
            <td>submit()</td>
            <td>*</td>
            <td>Submits a POST to the relevant repository.</td>
        </tr>
        <tr>
            <td>status()</td>
            <td>Authentication</td>
            <td>Returns the authentication status object.</td>
        </tr>
    </tbody>
</table>

Bug Reporting
---------

Please use the [GitHub Issues](https://github.com/stephenlake/AddPay-PHP-SDK/issues) tab to report any problems you are having with the package. I am fully aware that there are code lines that can be optimized using PHP7's new functionality, but I have deliberately avoided this to keep the package compatible with older version of PHP, please do not report performance improvements unless they are backward compatible.

## Contributing & Suggestions
[Create a pull request](https://github.com/stephenlake/addpay-php/pulls) at any point. **Do not suggest an addition or make a request for change in writing, just write the code and [submit a pull request](https://github.com/stephenlake/addpay-php/pulls)**, if it improves the package without generating any breaking changes and adds efficiency, then **it will be merged**. _I will ignore any demands/requests for changes without any  suggested code replacement and/or additions._

Disclaimer
---------

This package and all documentation was developed by Stephen Lake as a **personal** project to assist developers unfamiliar with the AddPay API in getting started quickly and efficiently. This is an **unofficial** package and therefore **_support is limited and provided as a courtesy_**.

## Todo
- Add caching layers:
  - Return immediate transaction object if the ID has already been instantiated
  - Return services from cache-store with low ttl in scenarios where a user might be oblivious to throttling
- Add Public Meta API
- Add Private API

