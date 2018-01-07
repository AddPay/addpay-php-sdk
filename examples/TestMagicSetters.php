<?php

require_once(__DIR__ . '/../core/AddPayOpenAPI.php');

/*
|--------------------------------------------------------------------------
| AddPay PHP Package
|--------------------------------------------------------------------------
|
| Read the API documentation at https://www.addpay.co.za/developers for more
| information on how this method works and the parameters it accepts.
|
| @Author: Stephen Lake <stephen@closurecode.com>
|
| With regard to support of this package, no questions that have already been
| answered in the API documentation will be answered from me. Please ensure
| you have thoroughly read through the entire document before raising concerns.
|
| If you believe there is a problem with this package, please use the ISSUES
| feature and create a new issue on the GitHub (pronounced with a G, not a J)
| page here: https://github.com/stephenlake/addpay-php/issues
|
| Thanks!
|
| THESE ARE **NOT** UNIT TESTS, THE UNIT TESTS ARE WITHIN GITIGNORE, THESE
| ARE MERELY TESTS TO ENSURE THERE ARE NO BREAKING CHANGES, THESE ARE NOT FOR
| THE PACKAGE USER, BUT FOR DEVELOPMENT TWEAKING PURPOSES AND TO DEMONASTRATE
| MAGIC METHODS.
|
*/

$t = $api->transactions()
          ->new()
          ->withSolidPrinciples('Yes')
          ->withAmazingTestingSkills('No, not today bruh.');
