$(document).ready(function () {

  //------------------------------------------------------------------------
  // Search
  //------------------------------------------------------------------------

  $("#search").focus().on("keyup", function () {
    //$.get("./index.php?route=ajaxSearch", {what: $(this).val()}, function (data) {
    $.get("./ajaxSearch.php", {what: $(this).val()}, function (data) {
      $("#searchres").html(data);
    });
  });

  //------------------------------------------------------------------------
  // menu
  //------------------------------------------------------------------------

  $("#fade").click(function () {
    $("aside").fadeToggle();
  });

});
