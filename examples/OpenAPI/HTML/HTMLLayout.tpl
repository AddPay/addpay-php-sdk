<div class="row mt-0 mb-0">
  <div class="col-lg-12 mt-0 mb-0">
    <?php
      if (isset($templateIncludes)) {
        foreach($templateIncludes as $template) {
          require($template);
        }
      }
     ?>
  </div>
</div>
