# AddPay PHP SDK
![Build Status](https://travis-ci.org/dwyl/esta.svg?branch=master)
![codecov.io Code Coverage](https://img.shields.io/codecov/c/github/dwyl/hapi-auth-jwt2.svg?maxAge=2592000)
![Code Climate](https://codeclimate.com/github/dwyl/esta/badges/gpa.svg)
![Dependency Status](https://david-dm.org/dwyl/esta.svg)
![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)
 
A PHP package to assist in developing applications communicating with the AddPay API.

# Getting Started
Please see the full list of examples for each action in the `examples` directory.

## Configuration
- Head to your developer portal or merchant console developer settings if your integration is live, find the section providing your `client_id` and `client_secret`, keep these credentials closeby.
- Open the configuration file in this package located at `path/to/this/package/config/config.json`
- Relace `your_client_id` with your actual `client_id`
- Replace `your_client_secret` with your actual `client_secret`
- If your integration is live, set `live` to `true`
- It is important to ensure the structure of the file is unchanged, the quotes are important!

## Running/Using Examples

### \* <img src="http://icons.iconarchive.com/icons/icons8/windows-8/256/Systems-Linux-icon.png" width="24"> Linux & Mac 
**Option 1 - Through the terminal**
- Open a new terminal
- Run the script with `php /path/to/addpay/package/examples/TransactionUpdate.php`

**Option 2 - PHP Internal Webserver**
- Open a new terminal
- Start a webserver on port 8080 with: `php -S localhost:8080 -t /path/to/addpay/package/examples/`
- Open `localhost:8080/ScriptNameHere.php` in your browser:
   - Example: `localhost:8080/TransactionUpdate.php`

### \* <img src="https://dotnetco.de/wp-content/uploads/2016/12/windows-icon256.png" width="24"> Windows
**Option 1 - Through the Command Line**
- Start a command prompt (Start button > Run > cmd.exe)
- In the window that appears, type the full path to the PHP executable (php.exe) followed by the full path to the script you wish to run:
   - Example: `C:\PHP\php.exe C:\path\to\addpay\package\examples\TransactionFind.php`

**Option 2 - PHP Internal Webserver**
- Start a command prompt (Start button > Run > cmd.exe)
- Type the full path to the PHP executable (php.exe) and start the webserver in wthe root directory being the examples directory:
   - Example: `C:\PHP\php.exe -S localhost:8080 -t C:\path\to\addpay\package\examples`
- Open `localhost:8080/ScriptNameHere.php` in your browser:
   - Example: `localhost:8080/TransactionFind.php`

## Disclaimer
This package and all documentation was developed by Stephen Lake as a **personal** project to assist new/beginner developers in getting on with the AddPay API. This is an **unofficial** package and therefore **_support is limited and provided as a courtesy_**.

## Contributing & Suggestions
[Create a pull request](https://github.com/stephenlake/addpay-php/pulls) at any point. **Do not suggest an addition or make a request for change in writing, just write the code and [submit a pull request](https://github.com/stephenlake/addpay-php/pulls)**, if it improves the package without generating any breaking changes and adds efficiency, then **it will be merged**. _I will ignore any demands/requests for changes without any  suggested code replacement and/or additions._

## Todo Later
- Add magic getters wiki documentation
- Add caching layers:
  - Return immediate transaction object if the ID has already been instantiated
  - Return services from cache-store with low ttl in scenarios where a user might be oblivious to throttling
- Add Public Meta API
- Add Private API
- Add PHPDoc


