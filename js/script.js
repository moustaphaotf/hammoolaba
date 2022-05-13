$(document).ready(function(){
  $('.row.grid').masonry({
    itemSelector : '[class*="col-"]',
    horizontalOrder : true
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

  // rendre les titre d'article du la page categorie(carousel) de meme longueur
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
      $(link).text($(link).text().slice(0, minLength) + ' ...');
    }

  }

  // page viewarticle, boutton supprimer
  $('.delete-article').on('click', function(e){
    e.preventDefault();
    // on demande confirmation avant de procéder
    if(confirm("Voulez-vous vraiment supprimer cet article ?")){
      $.ajax({
        url : 'deletearticle.php',
        type : 'GET',
        timeout : 10000,
        dataType : 'json',
        data : {
          id : $(this).data('articleId')
        },
        success : function(data){
          alert(data.status);
          if(data.status === 'success'){
            $('.alert .content').html("<i class='fa fa-check-circle'></i> La suppression de l'article a réussi. <a href='' class='alert-link'>Actualiser la page</a>");
            $('.alert').removeClass('d-none').addClass('show');
          }
          else if(data.status === 'error'){
            $('.alert .content').html("<i class='fa fa-exclamation-triangle'></i> L'article en question n'est plus disponnible ! <a href='' class='alert-link'>Actualiser la page</a>");
            $('.alert').removeClass('d-none alert-success').addClass('show alert-warning');
          }
        },
        error : function(){
          $('.alert .content').text("Erreur de requette ou temps d'attente trop long !");
          $('.alert').removeClass('d-none alert-success').addClass('alert-warning');
        }
      });
    }
  });
});