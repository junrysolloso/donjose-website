

$(function () {
  var p = document.getElementsByTagName("p");
  var li = document.getElementsByTagName("li");
  var img = document.getElementsByTagName("img");
  var pLen = p.length;
  var liLen = li.length;
  var imgLen = img.length;
  var w = $(window).width();
  if (w < 768) {
    for (var i = 0; i < pLen; i++) {
      p[i].classList.add('text-justify');
    }
  } else {
    for (var i = 0; i < pLen; i++) {
      p[i].classList.add('text-justify');
    }
  }
  for (var i = 0; i < liLen; i++) {
    li[i].classList.add('text-justify');
  }
  for (var i = 0; i < imgLen; i++) {
    img[i].setAttribute("alt", "Image");
  }
  var $container = $('.portfolio-items');
  $container.isotope({
    filter: '*',
    animationOptions: {
      duration: 750,
      easing: 'linear',
      queue: false
    }
  })
  $('.portfolio-item a').nivoLightbox({
    effect: 'slideDown',
    keyboardNav: true
  })
})
