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
*/

function getServices()
{
    global $api;

    $call = $api->services()
                ->withType('transaction')
                ->withIntent('SUBSCRIPTION')
                ->list();

    if ($call->succeeds()) {
        return $call->getData();
    }
    return [];
}

$services = getServices();

if (count($services)) {
?>

<div id="payment-options-table">
    <table style="width: 400px;">
      <tbody>
        <?php foreach ($services as $service): ?>
            <tr>
                <td>
                  <img src="<?php echo $service['icon']; ?>" width="64"/></td>
                <td>
                  <h3>
                    <?php echo $service['label']; ?><br/>
                    <small><?php echo $service['description']; ?></small>
                  </h3>
                </td>
            </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
</div>

<?php
} else {
        echo 'No services with intent SUBSCRIPTION were returned from the API. Please install you have read the API documentation on installing modules.';
}
?>
