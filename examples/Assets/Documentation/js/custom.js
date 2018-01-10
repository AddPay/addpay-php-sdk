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
        axios.get('/' + example.file.execPath).then(response => {
          this.activeExampleResult = response.data;
          this.activeExampleRunning = false;
        }).catch(e => {
          this.activeExampleResult = 'Whoops! Seems to be something wrong with your code! Please check it out and try again!';
          this.activeExampleRunning = false;
        });
      }.bind(this), 1500);
    }
  }
})
