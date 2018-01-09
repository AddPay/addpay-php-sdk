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
  <link href="Assets/Documentation/css/prism.css" rel="stylesheet">
  <link href="Assets/Documentation/css/custom.css" rel="stylesheet">
</head>

<body>
  <div id="examples">
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
        <div class="row">
          <div class="ml-auto mr-auto">
            <h3 class="text-center mb-5 mt-5">Open API Examples</h3>
            <table class="table table-responsive" style="width: 100%;">
              <thead>
                <tr>
                  <th>Example</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="example in openApiExamples">
                  <td>{{ example.category }} / <strong>{{ example.name }}</strong><br/><small>{{ example.file.absolutePath }}</small></td>
                  <td><button class="btn btn-sm btn-outline-dark" @click="openExampleModal(example)"><i class="fa fa-eye"></i> View</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="ml-auto mr-auto">
            <h3 class="text-center mb-5 mt-5">Public API Examples</h3>
            <table class="table table-responsive" style="width: 100%;">
              <thead>
                <tr>
                  <th>Example</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="example in publicApiExamples">
                  <td>{{ example.category }} / <strong>{{ example.name }}</strong><br/><small>{{ example.file.absolutePath }}</small></td>
                  <td><button class="btn btn-sm btn-outline-dark" @click="openExampleModal(example)"><i class="fa fa-eye"></i> View</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="ml-auto mr-auto">
            <h3 class="text-center mb-5 mt-5">Private API Examples</h3>
            <table class="table table-responsive" style="width: 100%;">
              <thead>
                <tr>
                  <th>Example</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="example in privateApiExamples">
                  <td>{{ example.category }} / <strong>{{ example.name }}</strong><br/><small>{{ example.file.absolutePath }}</small></td>
                  <td><button class="btn btn-sm btn-outline-dark" @click="openExampleModal(example)"><i class="fa fa-eye"></i> View</button></td>
                </tr>
              </tbody>
            </table>
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
    <div id="example-modal" class="modal fade">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" v-if="activeExample">
          <div class="modal-header">
            <h5 class="modal-title">{{ activeExample.name }}</h5>
            <button :disabled="activeExampleRunning" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
          </div>
          <div class="modal-body">
            <h4>The Code</h4>
            <button :disabled="activeExampleRunning" type="button" class="btn btn-default mb-4" @click="activeExampleCodeVisible = !activeExampleCodeVisible">{{ activeExampleCodeVisible ? 'Hide' : 'View' }} Code</button>
            <pre class="language-php" v-show="activeExampleCodeVisible" v-html="activeExample.file.content" style="font-size: 11px;"></pre>
            <br/>
            <h4 v-show="!activeExampleRunning">The Result</h4>
            <p v-show="activeExampleResult == false && !activeExampleRunning">Run the code first</p>
            <h3 v-show="activeExampleResult == false && activeExampleRunning"><i class="fa fa-refresh fa-spin"></i> Running code...</h3>
            <pre v-show="activeExampleResult" style="font-size: 11px;"><code v-html="activeExampleResult"></code></pre>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="runExampleCode(activeExample)" :disabled="activeExampleRunning"><i class="fa fa-refresh fa-spin" v-show="activeExampleRunning"></i> {{ activeExampleRunning ? 'Loading' : 'Run Example Code' }}</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" :disabled="activeExampleRunning">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    <?php echo 'window.openApiExamples = ' . json_encode(echoExampleFiles(__DIR__ . '/../../../OpenAPI', 'OpenAPI')) . ';'; ?>
    <?php echo 'window.publicApiExamples = ' . json_encode(echoExampleFiles(__DIR__ . '/../../../PublicAPI', 'PublicAPI')) . ';'; ?>
    <?php echo 'window.privateApiExamples = ' . json_encode(echoExampleFiles(__DIR__ . '/../../../PrivateAPI', 'PrivateAPI')) . ';'; ?>
  </script>
  <script type="text/javascript" src="Assets/Documentation/js/vue.js"></script>
  <script type="text/javascript" src="Assets/Documentation/js/axios.min.js"></script>
  <script type="text/javascript" src="Assets/Documentation/js/jquery.min.js"></script>
  <script type="text/javascript" src="Assets/Documentation/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="Assets/Documentation/js/jquery.easing.min.js"></script>
  <script type="text/javascript" src="Assets/Documentation/js/jquery.magnific-popup.min.js"></script>
  <script type="text/javascript" src="Assets/Documentation/js/freelancer.min.js"></script>
  <script type="text/javascript" src="Assets/Documentation/js/prism.js"></script>
  <script type="text/javascript" src="Assets/Documentation/js/prism-php.js"></script>
  <script type="text/javascript" src="Assets/Documentation/js/custom.js"></script>
</body>

</html>

<?php
    function echoExampleFiles($dir, $execPath = '', $results = array()) {
      $files = scandir($dir);

      $result = array();

      foreach($files as $key => $value){
          $path = realpath($dir.DIRECTORY_SEPARATOR.$value);

          if(!is_dir($path)) {
            if (endsWith($path, '.php')) {
              $result[] = [
                "name" => str_replace('.php', '', basename($path)),
                "category" => $execPath,
                "file" => [
                  "absolutePath" => $path,
                  "execPath"     => "{$execPath}/" . basename($path),
                  "content"      => file_get_contents($path),
                ]
              ];
            }
          } else if($value != "." && $value != "..") {
            $result = array_merge($result, echoExampleFiles($path, $execPath, $results));
          }
      }

      return $result;
    }
  ?>
