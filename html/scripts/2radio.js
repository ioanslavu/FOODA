$(function() {
  $("input[name$='value']").change(function() {
    window.location = this.value;
  });
});

