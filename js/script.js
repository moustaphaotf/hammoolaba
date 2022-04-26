$(document).ready(function(){
  $('.row.grid').masonry({
    itemSelector : '[class*="col-"]'
  });

  $('[data-bs-toggle="tooltip"]').tooltip();
});