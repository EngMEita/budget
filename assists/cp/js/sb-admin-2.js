$(function() {
  $('#side-menu').metisMenu();
  $(window).bind("load resize", function() {
    topOffset = 50;
    width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
    if (width < 768) {
      $('div.navbar-collapse').addClass('collapse');
      topOffset = 100; // 2-row-menu
    } else {
      $('div.navbar-collapse').removeClass('collapse');
    }

    height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
    height = height - topOffset;
    if (height < 1) height = 1;
    if (height > topOffset) {
      $("#page-wrapper").css("min-height", (height) + "px");
    }
  });
});
$(document).ready(function () {
  var url = window.location;
  $('a[href="'+ url +'"]').addClass("active");
  $('.sel2').select2({
    dir: "rtl"
  });
  $(".money").focusin(function(){
    var val = $(this).val();
    if(val == "0.00")
    {
      $(this).val("");
    }
  });
  $(".money").focusout(function(){
    var val = $(this).val();
    if(val == "")
    {
      $(this).val("0.00");
    }
  });
});