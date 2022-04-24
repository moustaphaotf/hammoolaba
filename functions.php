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