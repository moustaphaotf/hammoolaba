<?php
  $hname = "localhost";
  $uname = "hammoolaba";
  $dbase = "hammoolaba_db";
  $pword = "admin123456";

  $config_imgarticle_folder = "Images/articles";
	if(defined('MAX_ARTICLES_PER_PAGE') === false){
    define('MAX_ARTICLES_PER_PAGE', 6);
  }

  if(defined('USER') === false){
    define('USER', 0);
  }

  if(defined('USER_ADMIN') === false){
    define('USER_ADMIN', 1);
  }

  if(defined('USER_SUPER') === false){
    define('USER_SUPER', 2);
  }

