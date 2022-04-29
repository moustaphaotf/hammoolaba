$(document).ready(function(){
  $('.row.grid').masonry({
    itemSelector : '[class*="col-"]'
  });

  $('[data-bs-toggle="tooltip"]').tooltip();

  // autochange le logo du boutton du panneau de navigation
  $("#menu").on('show.bs.collapse', function(){
    let btn = $('.btn-nav-action');
    let fa = $(btn).children();
    $(btn).removeClass('action-open').addClass('action-close');
    $(fa).removeClass('fa-bars').addClass('fa-close')
  });

  $("#menu").on('hidden.bs.collapse', function(){
    let btn = $('.btn-nav-action');
    let fa = $(btn).children();
    $(btn).removeClass('action-close').addClass('action-open');
    $(fa).removeClass('fa-close').addClass('fa-bars')
  });
});