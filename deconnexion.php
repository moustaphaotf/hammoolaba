<?php
session_start();
$_SESSION['USER_ID'] = '';
$_SESSION['USER_NAME'] = '';
$_SESSION['USER_USERNAME'] = '';
$_SESSION['USER_EMAIL'] = '';
$_SESSION['USER_ROLE'] = '';

session_destroy();

header("Location:index.php");
