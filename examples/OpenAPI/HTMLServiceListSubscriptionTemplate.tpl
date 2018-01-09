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
