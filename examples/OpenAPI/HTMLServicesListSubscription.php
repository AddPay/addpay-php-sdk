<?php

require_once(__DIR__ . '/../core/AddPayOpenAPI.php');
require_once('Lib/Helpers.php');

$htmlHelper->getHeader('Service List Page: Type SUBSCRIPTION');

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

$htmlHelper->getFooter();
?>
