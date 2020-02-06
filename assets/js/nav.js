 
$(function () {
  var tmp = "";
  $(window).bind('scroll', function () {
    var h = $(window).height() - 650;
    if($(window).scrollTop() > h) {
      $("#head-bg").slideUp('fast');
    } else {
      $("#head-bg").slideDown('fast');
    }
  })
  $(".mainButton").mouseenter(function () {
    var id = $(this).attr("id");
    $(".subNav-bg").hide();
    $(".subNav-academics").hide();
    $('.mainButton').removeClass('mainBtn');
    $(this).addClass('mainBtn');
    $("#nav" + id).slideDown('fast');
  })
  $(".subBtnAcademics").mouseenter(function () {
    var id = $(this).attr("id");
    tmp = id;
    $(".subNav-academics").hide();
    $(".subBtnAcademics").removeClass('subBtn');
    $(this).addClass('subBtn');
    $("#nav" + id).slideDown('fast');
  })
  $(".subNav-academics").mouseenter(function () {
    $("#" + tmp).addClass('subBtn');
  })
})
