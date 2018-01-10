<?php if(isset($services) && count($services)) { ?>
<div id="payment-options-table">
  <br/>
  <h5 style="font-weight: 300;"><i class="fa fa-batter-full"></i> Availabe Payment Methods!</h5>
  <br/>
  <table class="table table-striped">
    <tbody>
      <?php foreach ($services as $service): ?>
      <tr>
        <td>
          <img src="<?php echo $service['icon']; ?>" width="96" /></td>
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
<?php } else { ?>
<div id="payment-options-table">
  <h5 style="font-weight: 300;"><i class="fa fa-battery-empty"></i> Sorry! No payment services of this type found on your account!</h5>
</div>
<?php } ?>
