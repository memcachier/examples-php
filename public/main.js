$(function() {
  $("input[data-compute]").live("click", function() {
    var prime = $("#prime");
    prime.html("Working ...");
    $.get(
      "/compute.php?n=" + $("#n").val(),
      function(data) {
        prime.html(data);
      }
    );
  });
});