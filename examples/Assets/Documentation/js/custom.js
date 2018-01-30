window.baseUrl = window.location.href.toString().replace('index.php', '');

var examples = new Vue({
  el: '#examples',
  data: {
    activeExample: false,
    activeExampleCodeVisible: false,
    activeExampleRunning: false,
    activeExampleResult: false,
    openApiExamples: [],
  },
  computed: {
    resultIsHTML() {
      var a = document.createElement('div');
      a.innerHTML = this.activeExampleResult;

      for (var c = a.childNodes, i = c.length; i--;) {
        if (c[i].nodeType == 1) return true;
      }

      return false;
    }
  },
  mounted() {
    this.parseExamples()
  },
  methods: {
    parseExamples() {
      this.openApiExamples = window.openApiExamples;
    },
    openExampleModal(example) {
      this.activeExample = example;
      this.activeExampleResult = false;
      this.activeExampleRunning = false;
      this.activeExampleCodeVisible = false;

      $('#example-modal').modal('show');
    },
    runExampleCode(example) {
      this.activeExampleResult = false;
      this.activeExampleRunning = true;
      this.activeExampleCodeVisible = false;

      setTimeout(function() {
        axios.get(window.baseUrl + '/' + example.file.execPath).then(response => {
          this.activeExampleResult = response.data;
          this.activeExampleRunning = false;
        }).catch(e => {
          this.activeExampleResult = ''
          + '<div>'
          + '<p>Whoops! Something went wrong, likely one of the following:</p>'
          + '<ul>'
          + '<li class="red"><strong>Have you setup the configuration file correctly?</strong></li>'
          + '<li class="red"><strong>If processing a transaction example, have you actually updated the example file with a real transaction ID in place of TRANSACTION_ID_HERE?</strong></li>'
          + '<li>If you changed code in the example, there might be a syntax issue - <strong>most common issue</strong>, check your PHP web server console if there is any red or warning text there.</li>'
          + '<li>Your webserver is no longer or was never running.</li>'
          + '<li>You are no longer or never were connected to the internet.</li>'
          + '</ul>'
          + '<p>If you insist you have done nothing wrong and none of the above are applicable, please create an ISSUE on the repository at <a href="https://github.com/stephenlake/AddPay-PHP-SDK/issues">StephenLake/AddPay-PHP-SDK</a>. Please <strong>do not send me emails</strong>, I already get notified via GitHub issues.<br/><br/><strong>When creating an issue, '
          + 'please provide your PHP version as well as the output in your webserver console or error log file as I cannot help you debug without this information.</strong>'
          + '</p>'
          + '</div>';
          this.activeExampleRunning = false;
        });
      }.bind(this), 1500);
    }
  }
})
