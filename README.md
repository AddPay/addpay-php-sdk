# [AddPay PHP](https://github.com/stephenlake/addpay-php) - For Dummies
![Build Status](https://travis-ci.org/dwyl/esta.svg?branch=master)
![codecov.io Code Coverage](https://img.shields.io/codecov/c/github/dwyl/hapi-auth-jwt2.svg?maxAge=2592000)
![Code Climate](https://codeclimate.com/github/dwyl/esta/badges/gpa.svg)
![Dependency Status](https://david-dm.org/dwyl/esta.svg)
![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)
 
A PHP package to assist in developing applications communicating with the AddPay API. The package already exists elsewhere, but due to someone's lack of understanding of API's, this is a replica with **spoon-feeding methods** for non-developers that don't know how to write object orientated code or use native PHP functions to build JSON payloads.

### Best "Developer" Statement 2018:
> You should define all the available methods. I don't want to deal with low-level code.

GET, PUT, POST, PATCH, DELETE. Do you even know what RESTFUL API is?!

On a serious note, here are all the methods for those who don't get the joke:
[All Methods](https://github.com/stephenlake/addpay-php/blob/master/core/Foundation/Protocol/BaseProtocol.php)

### [Wiki & Samples Here](https://github.com/stephenlake/addpay-php/wiki)

## Contributing & Suggestions
[Create a pull request](https://github.com/stephenlake/addpay-php/pulls) at any point. **Do not suggest an addition or make a request for change in writing, just write the code and [submit a pull request](https://github.com/stephenlake/addpay-php/pulls)**, if it improves the package without generating any breaking changes and adds efficiency, then **it will be merged**. _I will ignore any demands/requests for changes without any  suggested code replacement and/or additions._

## Todo Later
- Idiot-proofing:
  - Add magic getters to prevent exceptions being thrown on null value getters
  - Replace standard exceptions with custom exceptions to provide better idiot-proof error messages
- Add caching layers:
  - Return immediate transaction object if the ID has already been instantiated
  - Return services from cache-store with low ttl in scenarios where a user might be oblivious to throttling
- Add Public Meta API
- Add Private API
- Add PHPDoc


