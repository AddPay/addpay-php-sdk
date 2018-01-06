# AddPay PHP
A PHP package to assist in developing applications communicating with the AddPay API. The package contains minimalistic wrappers around the Public, Private and Open API's. This package was written specifically for an incredibly difficult individual who has no understanding of JSON API's and thinks that to add a new field to a JSON object, a new PHP class is required, apparently this is called "low-level code"... :trollface: :trollface: :trollface: :trollface:

## Quick Introduction and Gotcha's
While developing the package with the above troublesome "developer" in mind, this package has some magic method handlers, the major method being the `with` method call which is received by the internal `__call` method. Think of the `with` method as a wildcard method that allows you to set a JSON payload with anything following the `with` word, for example:

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
