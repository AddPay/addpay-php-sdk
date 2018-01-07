# AddPay PHP
![Build Status](https://travis-ci.org/dwyl/esta.svg?branch=master)
![codecov.io Code Coverage](https://img.shields.io/codecov/c/github/dwyl/hapi-auth-jwt2.svg?maxAge=2592000)
![Code Climate](https://codeclimate.com/github/dwyl/esta/badges/gpa.svg)
![Dependency Status](https://david-dm.org/dwyl/esta.svg)
![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)
 
A PHP package to assist in developing applications communicating with the AddPay API. The package already exists elsewhere, but due to someone's lack of understanding of API's, this is a replica with **spoon-feeding methods** for non-developers that don't know how to write object orientated code or use native PHP functions to build JSON payloads.

## [Wiki](https://github.com/stephenlake/addpay-php/wiki)
- [Questions & Answers](https://github.com/stephenlake/addpay-php/wiki/Questions-&-Answers) - Please read this before asking questions
- [Missing Methods? Nope, Magic Methods.](https://github.com/stephenlake/addpay-php/wiki/Missing-Methods%3F-Nope.)
- [Getting Started](https://github.com/stephenlake/addpay-php/wiki/Getting-Started)
- [Different API's](https://github.com/stephenlake/addpay-php/wiki/Different-API's)
- [Samples](https://github.com/stephenlake/addpay-php/wiki/Samples)

## Contributing & Suggestions
[Create a pull reqest](https://github.com/stephenlake/addpay-php/pulls) at any point. Do not suggest an addition or make a request for change in writing, just do it and [submit a pull request](https://github.com/stephenlake/addpay-php/pulls). I will ignore any messages doing otherwise.

## Todo Later
- Idiot-proofing:
  - Add magic getters to prevent exceptions being thrown on null value getters
  - Replace standard exceptions with custom exceptions to provide better idiot-proof error messages
- Add caching layers:
  - Return immediate transaction object if the ID has already been instantiated
  - Return services from cache-store with low ttl in scenarios where a user might be oblivious to throttling
- Add Public Meta API
- Add Private API


