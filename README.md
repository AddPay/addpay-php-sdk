# AddPay PHP
A PHP package to assist in developing applications communicating with the AddPay API. The package already exists elsewhere, but due to someone's lack of understanding of API's, this is a replica with **spoon-feeding methods**. This package was written specifically for an incredibly difficult individual who has no understanding of JSON API's and thinks that to add a new field to a JSON object, a new PHP class is required, apparently calling the native PHP function `json_encode()` is too "low-level"... :trollface: :trollface: :trollface: :trollface:

# Read This First - Q&A for the not-so-bright

### Does this package require composer? I can't use composer!?!
No. Then don't use it.

### Why is there a composer.json and composer.lock file then?
The package was **built** using composer.

### I get an error saying `AddPayOpenAPI.php` does not exist? Your package is broken!
No, the package is fine. You need to load the AddPayOpenAPI.php file relative to your working path.

### Why don't you provide examples of every API call?
Read the fucking AddPay API documentation before asking idiotic questions like these, you'll then realize why you sound like a tool.

### Why don't you provide examples of every method call?
I do. Read the code, [it's right here](https://github.com/stephenlake/addpay-php/tree/master/Foundation).

### Is this package unit tested?
Yes.

### Why didn't you just update the previous package?
Because there are many developers that actually know what they are doing using it as is; There's no need to update it.

# Important Note
While developing the package for the with the above mentioned "developer" in mind, this package has some magic method handlers, the major method being the `with` method call which is received by the internal `__call` method. Think of the `with` method as a wildcard method that allows you to set a JSON payload with anything following the `with` word, for example:

Calling `withReference('SOMEREFERENCE')` will set a payload of:
```json
{
  "reference": "SOMEREFERENCE"
}
```
Nested fields are set by calling the `with` method with camel-cased fields, for example, calling `withAmountValue('1.50')` will result in the following payload:
```json
{
   "reference": "SOMEREFERENCE",
   "amount": {
      "value": "1.50"
   }
}
```
Some special-case methods have been put into place to prevent unexpected results, for example given the above information on camel-cased fields, you'd expect calling `withAmountCurrencyCode('USD')` to return:
```json
{
  "amount": {
    "currency": {
      "code": "USD"
    }
  }
}
```
However, the AddPay API requirement is to have `currency_code` as a single attribute and therefore a fallback method has been provided which allows you to simply call `withAmountCurrencyCode('USD')` and you will receive the correct output:
```json
{
   "reference": "SOMEREFERENCE",
   "amount": {
      "value": "1.50",
      "currency_code": "USD"
   }
}
```
Alernatively you could enforce it with an underscore by calling `withAmountCurreny_code('USD')` but that's really ugly code to work with, in my personal opinion anyway.

## IF YOU STILL DON'T GET IT, IT MEANS YOU CAN CALL:
`withAnythingYouWantHere('AND A VALUE HERE');`
## AND JSON PAYLOAD WILL BE BUILT! TRY READING! IT HELPS!
```
{
  "anything": {
    "you": {
      "want": {
        "here": "AND A VALUE HERE"
      }
    }
  }
}
```
## *ANYTHING*:
```php
withMe('Stephen');
```
## Outputs:
```json
{
   "me": "Stephen"
}
```

## *ANYTHING*:
```php
withWooHoo('I can read');
```
## Outputs:
```json
{
   "woo": {
     "hoo": "I can read"
   }
}
```
### /endrant... Let's start working with the package....

# Getting Started

## Grab your client_id and client_secret
Head to your developer portal, find the section providing your sandbox client_id and client_secret. If you're already live, use your live credentials instead.

## Edit the configuration file
Open up `Config/config.json` within the package root, edit and replace the default values in each field.

# Usage Examples

## Open API
The open API provides an API interface to handle objects around transactions and the processing of them. Below we provide some examples of using the API. Please first read the API documentation at https://www.addpay.co.za/developers before diving in to grasp an understanding of the API.

### Instantiating the Open API
If you have no idea what this mean, look at the examples :trollface:
```php
require_once(__DIR__ . '/core/AddPayOpenAPI.php');
```
An exception will be thrown if the configuration file is missing fields.

### Services
Services are required when switching transaction payment modules or creating your own payment page. See the AddPay API documentation for more information on where you'd use these calls.

#### List General Available Services
```php
$serviceList = $api->services()
                       ->list();

if ($serviceList->succeeds()) {
    echo "Cool, we got a list of general services that we can use:";

    print_r($serviceList);
    exit;
} else {
    $errorCode = $serviceList->getErrorCode();
    $errorMsg  = $serviceList->getErrorMessage();

    echo "Aww! Got error code {$errorCode} with message {$errorMsg}.";
}
```

#### List Available Payment Module Services
```php
$serviceList = $api->services()
                       ->withType('transaction')
                       ->list();

if ($serviceList->succeeds()) {
    echo "Cool, we got a list of payment modules that we have access to:";

    print_r($serviceList);
    exit;
} else {
    $errorCode = $serviceList->getErrorCode();
    $errorMsg  = $serviceList->getErrorMessage();

    echo "Aww! Got error code {$errorCode} with message {$errorMsg}.";
}
```


#### List Available Payment Module Services that support the SALE intent
```php
$serviceList = $api->services()
                       ->withType('transaction')
                       ->withIntent('SALE')
                       ->list();

if ($serviceList->succeeds()) {
    echo "Cool, we got a list of payment modules that we have access to and support the SALE intent:";

    print_r($serviceList);
    exit;
} else {
    $errorCode = $serviceList->getErrorCode();
    $errorMsg  = $serviceList->getErrorMessage();

    echo "Aww! Got error code {$errorCode} with message {$errorMsg}.";
}
```

#### List Available Payment Module Services that support the SUBSCRIPTION intent
```php
$serviceList = $api->services()
                       ->withType('transaction')
                       ->withIntent('SUBSCRIPTION')
                       ->list();

if ($serviceList->succeeds()) {
    echo "Cool, we got a list of payment modules that we have access to and support the SALE intent:";

    print_r($serviceList);
    exit;
} else {
    $errorCode = $serviceList->getErrorCode();
    $errorMsg  = $serviceList->getErrorMessage();

    echo "Aww! Got error code {$errorCode} with message {$errorMsg}.";
}
```

### Transactions
Creating, retreiving, updating, processing and cancelling of transactions are described here.

#### Fetching a transaction
```php
$transaction = $api->transactions()->find('TRANSACTION_ID_HERE');
```

#### Creating a SALE transaction
```php
$transaction = $api->transactions()
                       ->new()
                       ->withReference('MyRef')
                       ->withDescription('This is my transaction')
                       ->withCustomerFirstname('CustomerFirstname')
                       ->withCustomerLastname('CustomerLastname')
                       ->withCustomerEmail('customer@example.org')
                       ->withCustomerMobile('000000000')
                       ->withServiceIntent('SALE')
                       ->withServiceKey('DIRECTPAY')
                       ->withAmountValue('1.50')
                       ->withAmountCurrencyCode('USD')
                       ->store(); // Or ->create();
```


#### Creating a SUBSCRIPTION transaction
```php
$transaction = $api->transactions()
                       ->new()
                       ->withReference('MyRef')
                       ->withDescription('This is my transaction')
                       ->withCustomerFirstname('CustomerFirstname')
                       ->withCustomerLastname('CustomerLastname')
                       ->withCustomerEmail('customer@example.org')
                       ->withCustomerMobile('000000000')
                       ->withServiceIntent('SUBSCRIPTION')
                       ->withContractType('ELASTIC')
                       ->withContractCount('2')
                       ->withContractMaxAmount('2.50')
                       ->withContractInterval('DAY')
                       ->withServiceKey('DIRECTPAY')
                       ->withAmountValue('1.50')
                       ->withAmountCurrencyCode('USD')
                       ->store(); // Or ->create();
```

#### Creating a DONATION transaction
```php
$transaction = $api->transactions()
                       ->new()
                       ->withReference('MyRef')
                       ->withDescription('This is my transaction')
                       ->withCustomerFirstname('CustomerFirstname')
                       ->withCustomerLastname('CustomerLastname')
                       ->withCustomerEmail('customer@example.org')
                       ->withCustomerMobile('000000000')
                       ->withServiceIntent('DONATION')
                       ->withServiceKey('DIRECTPAY')
                       ->store(); // Or ->create();
```

#### Updating a transaction's instrument
See the Transaction Reference Object on the AddPay Developer Documentation for a full list of fields that may be updated.
```php
$transaction = $api->transactions()
                       ->withId('TRANSACTION_ID_HERE')
                       ->withInstrumentType('CARD')
                       ->withInstrumentNumber('4242424242424242')
                       ->withInstrumentCode('123')
                       ->withInstrumentExpiryMonth('01')
                       ->withInstrumentExpiryYear('2050')
                       ->update();
```

#### Updating a transaction's intitaites_at date
See the Transaction Reference Object on the AddPay Developer Documentation for a full list of fields that may be updated.
```php
$transaction = $api->transactions()
                       ->withId('TRANSACTION_ID_HERE')
                       ->withInitiatesAt('2050-01-01')
                       ->update();
```

#### Processing a transaction
Processing a transaction has several steps. Please see the Self-Hosted Payment Page section of the AddPay Developer Documentation if you processing through your own payment page, otherwise see the AddPay-Hosted Payment Page section.
```php
$transaction = $api->transactions()
                       ->withId('TRANSACTION_ID_HERE')
                       ->process();
```

#### Cancelling a transaction
```php
$transaction = $api->transactions()
                       ->withId('TRANSACTION_ID_HERE')
                       ->cancel();
```

### Transaction Result Handling

#### Spitting out the raw result
```php
print_r($transaction->resource);

// Or get a specific object
print_r($transaction->resource['customer'];

// Or a get a specific field
echo $transaction->resource['customer']['firstname'];
```

#### Checking the transaction state
Please see the AddPay Developer Documentation for a full list of `status` keys and what to do for each status.
```php
if ($transaction->statusIs(AddPayOpenAPI::STATE_COMPLETED)) {
  // Do what you need to do.
} elseif($transaction->statusIs(AddPayOpenAPI::STATE_FAILED)) {
  // Do what you need to do, etc, etc,
}
```

### Public API
The public API provides some useful geographical meta data that can be used in improving your application, this meta data includes the current exchange rate values, list of world countries and currencies, etc.

This section will be updated soon!

### Private API
The private API allows an authenticated user to control their configuration of the Merchant Console and change their settings directly through the API.

This section will be updated soon!

**This package README has been dumbed-down a lot, it will be updated with more professional layout and content at a later stage.**
