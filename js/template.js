$(document).ready(function () {
  // var pos = window.location.href.search("#");
  // if(pos > -1){
  // var section = window.location.href.substr(pos,window.location.href.length-pos)

  // $("html, body").animate({
  //     scrollTop: $(section).offset().top - 50
  // }, 'slow');
  // }
  /**
   * open side menu
   */
  $("#OpenMenu").click(function () {
    $("#SideMenu").css("width", "100%").slideDown();
  });

  /**
   * close side menu
   */
  $("#CloseMenu").click(function () {
    $("#SideMenu").css("width", "0%");
  });
});
