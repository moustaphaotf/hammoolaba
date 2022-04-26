<?php
function date_duree($from){
  $to = time();
  $from = strtotime($from);

  $diff = ($to - $from);

  if($diff < 3600){
    $duree = sprintf("%d", $diff / 60);
    return "Il y a " . $duree . " minute" . ($duree > 1 ? "s" : "");
  }
  else if($diff < 86400){
    $duree = sprintf("%d", $diff / 3600);
    return "Il y a " . $duree . " heure" . ($duree > 1 ? "s" : "");
  }
  else if($diff < 86400 * 7){
    $duree = sprintf("%d", $diff / 86400);
    return "Il y a " . $duree . " jour" . ($duree > 1 ? "s" : "");
  }
  else
    return date('D d M Y H:i', $from);
}

function article($datas){
  require "config.php";
  return 
  '<div class="grid-item col-lg-4">'
    . '<div class="d-flex flex-column">'
      . '<div class="image_article"><img src="' . $config_imgarticle_folder . '/' . $datas['imgpath'] . '" alt="' . $datas['title'] . '" width="100%"></div>'
      . '<div>'
          . '<h5 class="article-title"><a href="article.php?id='. $datas['id'] . '">'. $datas['title'] . '</a></h5>'
          . '<p class="infos-sup"><span class="auteur-article">Mamadou Moustapha Diallo</span> - <span class="heure-publication">' . date_duree($datas['dateposted']) . '</span></p>'
      . '</div>'
    . '</div>'
  . '</div>';
}