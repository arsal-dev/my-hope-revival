$(window).scroll(function(e){ 
  var $el = $('.header'); 
  var isPositionFixed = ($el.css('position') == 'fixed');
  if ($(this).scrollTop() > 20 && !isPositionFixed){ 
    $el.css({'position': 'fixed', 'top': '0px' , '  transition': '2s'}); 
  }
  if ($(this).scrollTop() < 20 && isPositionFixed){
    $el.css({'position': 'static', 'top': '0px'}); 
  } 
});