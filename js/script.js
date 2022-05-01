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

  // le carousel de la page category
  $('.myCarousel').slick({
    infinite : false,
    slidesToShow : 4,
    slidesToScroll : 4,
    speed : 500,
    lazyLoad : true,
    
    // responsive
    responsive :[
      {
        breakpoint : 576,
        settings :{
          fade : true,
          slidesToShow : 1,
          slidesToScroll : 1
        }
      },
      
      {
        breakpoint : 768,
        settings :{
          slidesToShow : 2,
          slidesToScroll : 1
        }
      },
      
      {
        breakpoint : 992,
        settings :{
          slidesToShow : 3,
          slidesToScroll : 1
        }
      }
    ]
  })

  let carousels = $('.myCarousel')
  for (carousel of carousels){
    links = $(carousel).find('.article-title a');
    
    // plus petite longueur de texte
    let minLength = $(links[0]).text().length;
    for(link of links){
      if($(link).text().length < minLength){
        minLength = $(link).text().length;
      }
    }

    for(link of links){
      $(link).text($(link).text().slice(0, minLength) + ' ...')
    }

  }
});