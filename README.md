# [AddPay PHP](https://github.com/stephenlake/addpay-php)
![Build Status](https://travis-ci.org/dwyl/esta.svg?branch=master)
![codecov.io Code Coverage](https://img.shields.io/codecov/c/github/dwyl/hapi-auth-jwt2.svg?maxAge=2592000)
![Code Climate](https://codeclimate.com/github/dwyl/esta/badges/gpa.svg)
![Dependency Status](https://david-dm.org/dwyl/esta.svg)
![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)
 
A PHP package to assist in developing applications communicating with the AddPay API. A well-extended package already exists elsewhere, but for beginner developers that don't know how to write object orientated code, have no clue what a RESTFUL API is or don't know how to use native PHP functions to build JSON payloads, this is for you.

### Best "Developer" Statement 2018:
> You should define all the available methods. I don't want to deal with low-level code.

GET, PUT, POST, PATCH, DELETE. Do you even know what RESTFUL API is?! :trollface:

On a serious note, here are all the methods for those who don't get the joke:
[All Methods](https://github.com/stephenlake/addpay-php/blob/master/core/Foundation/Protocol/BaseProtocol.php)

### [Wiki & Samples Here](https://github.com/stephenlake/addpay-php/wiki)

## Contributing & Suggestions
[Create a pull request](https://github.com/stephenlake/addpay-php/pulls) at any point. **Do not suggest an addition or make a request for change in writing, just write the code and [submit a pull request](https://github.com/stephenlake/addpay-php/pulls)**, if it improves the package without generating any breaking changes and adds efficiency, then **it will be merged**. _I will ignore any demands/requests for changes without any  suggested code replacement and/or additions._

## Changelog
- 2018/01/06
  - Created package
  - Added Examples
  - Added Wiki, Disclaimer, Contributions Header
  
- 2018/01/07
  - Added YouTube video on REST JSON API's to Wiki for those who refuse to read
  - Added magic getters alongside magic setters
  - Removed native PHP error exceptions to prevent newbies from thinking the package is broken meanwhile they're using it wrong. Now you won't see any errors on calling `getAnthingHere()`, but instead receive a null value where applicable.

## Disclaimer
This package and all documentation was developed by Stephen Lake as a **personal** project to assist new/beginner developers in getting on with the AddPay API. This is an **unofficial** package and therefore **_support is limited and provided as a courtesy_**.

## Todo Later
- Idiot-proofing:
  - Add magic getters wiki documentation
- Add caching layers:
  - Return immediate transaction object if the ID has already been instantiated
  - Return services from cache-store with low ttl in scenarios where a user might be oblivious to throttling
- Add Public Meta API
- Add Private API
- Add PHPDoc


