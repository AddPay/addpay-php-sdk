  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>AddPay PHP SDK - Documentation</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="Assets/Documentation/css/bootstrap.min.css" rel="stylesheet">
    <link href="Assets/Documentation/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="Assets/Documentation/css/magnific-popup.css" rel="stylesheet" type="text/css">
    <link href="Assets/Documentation/css/freelancer.min.css" rel="stylesheet">
    <link href="Assets/Documentation/css/custom.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">AddPay PHP SDK - Documentation</a>
      </div>
    </nav>
    <div class="container">
      <section class="mt-5 mb-0">
        <div class="row mt-5">
          <div class="col-lg-6 ml-auto">
            <h3 class="text-center text-uppercase mb-5">Running in Browser</h3>
            <p class="text-center lead">Edit the script file accordingly, then simply enter the URL to it in your browser. Alernatively just click one of the scripts below.</p>
          </div>
          <div class="col-lg-6 mr-auto">
            <h3 class="text-center text-uppercase mb-5">Running in CLI</h3>
            <p class="text-center lead">Edit the script file accordingly, then simply run it in CLI:<br/><code>php path/to/script.php</code>. Alernatively just click one of the scripts below.</p>
          </div>
        </div>
        <div class="row mt-5">
          <div class="ml-auto mr-auto">
            <h1 class="text-center text-uppercase mb-5">In Browser Examples</h1>
            <div class="mt-4">
              <?php echoOpenApiExamples(); ?>
              <?php echoPublicApiExamples(); ?>
              <?php echoPrivateApiExamples(); ?>
            </div>
          </div>
        </div>
      </section>
    </div>
    <footer class="footer text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4 ml-auto mr-auto mb-lg-0">
            <h4 class="text-uppercase mb-4">CREATED WITH LOVE<br/><small>By Stephen Lake</small></h4>
          </div>
        </div>
      </div>
    </footer>
    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Check out more awesome stuff at <a href="https://github.com/stephenlake" target="_blank">Stephen Lake's GitHub Profile</a></small>
      </div>
    </div>
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-6">
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Project Name</h2>
              <hr class="star-dark mb-5">
              <img class="img-fluid mb-5" src="img/portfolio/submarine.png" alt="">
              <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
              <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
                <i class="fa fa-close"></i>
                Close Project</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="Assets/Documentation/js/jquery.min.js"></script>
    <script src="Assets/Documentation/js/bootstrap.bundle.min.js"></script>
    <script src="Assets/Documentation/js/jquery.easing.min.js"></script>
    <script src="Assets/Documentation/js/jquery.magnific-popup.min.js"></script>
    <script src="Assets/Documentation/js/freelancer.min.js"></script>
  </body>
  </html>

  <?php
    function echoOpenApiExamples() {
      echo '<h3>OpenAPI Examples</h3><br/>';
      echo '<table class="table table-responsive" style="width: 100% !important;">';
      echo '  <thead>';
      echo '    <tr>';
      echo '      <th>Example</th>';
      echo '      <th>Action</th>';
      echo '    </tr>';
      echo '  </thead>';
      echo '  <tbody>';
            echoExampleFiles(__DIR__ . '/../../../OpenAPI', 'OpenAPI');
      echo '  </tbody>';
      echo '</table>';
    }

    function echoPublicApiExamples() {
      echo '<h3>PublicAPI Examples</h3><br/>';
      echo '<table class="table table-responsive" style="width: 100% !important;">';
      echo '  <thead>';
      echo '    <tr>';
      echo '      <th>Example</th>';
      echo '      <th>Action</th>';
      echo '    </tr>';
      echo '  </thead>';
      echo '  <tbody>';
            echoExampleFiles(__DIR__ . '/../../../PublicAPI', 'PublicAPI');
      echo '  </tbody>';
      echo '</table>';
    }

    function echoPrivateApiExamples() {
      echo '<h3>PrivateAPI Examples</h3><br/>';
      echo '<table class="table table-responsive" style="width: 100% !important;">';
      echo '  <thead>';
      echo '    <tr>';
      echo '      <th>Example</th>';
      echo '      <th>Action</th>';
      echo '    </tr>';
      echo '  </thead>';
      echo '  <tbody>';
            echoExampleFiles(__DIR__ . '/../../../PrivateAPI', 'PrivateAPI');
      echo '  </tbody>';
      echo '</table>';
    }

    function echoExampleFiles($dir, $execPath = '', $results = array()) {
      $files = scandir($dir);

      foreach($files as $key => $value){
          $path = realpath($dir.DIRECTORY_SEPARATOR.$value);

          if(!is_dir($path) && ends_with($path, '.php')) {
              echo '<tr>';
              echo '<td><strong>' . $execPath . '/</strong>' . basename($path) . '<br/><small>(' . $path . ')</small></td>';
              echo '<td><button class="btn btn-sm btn-outline-dark" type="button">Execute</button></td>';
              echo '</tr>';
          } else if($value != "." && $value != "..") {
              echoExampleFiles($path, $execPath, $results);
              $results[] = $path;
          }
      }
    }
  ?>
