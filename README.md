# AddPay PHP
A PHP package to assist in developing applications communicating with the AddPay API. The package already exists elsewhere, but due to someone's lack of understanding of API's, this is a replica with **spoon-feeding methods** for non-developers that don't know how to write object orientated code or use native PHP functions to build JSON payloads.

## Index
- [Questions & Answers](https://github.com/stephenlake/addpay-php/wiki/Questions-&-Answers) - Please read this before asking questions
- [Missing Methods? Nope.](https://github.com/stephenlake/addpay-php/wiki/Missing-Methods%3F-Nope.) - Magic Methods
- [Getting Started](https://github.com/stephenlake/addpay-php/wiki/Getting-Started)

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
                       ->withInstrumentCvv('123')
                       ->withInstrumentExpiryMonth('01')
                       ->withInstrumentExpiryYear('2050')
                       ->update();
```

#### Updating a transaction's intitiates_at date
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
