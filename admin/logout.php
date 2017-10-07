<?php
// Begin the session
session_start();

// Unset all of the session variables.
session_unset();

// Destroy the session.
session_destroy();
/*
unset($_COOKIE['id']);
setcookie('id', null, -1, '/');
*/



$cookie_name = 'id';
unset($_COOKIE['id']);
$res = setcookie("id", '', time()-3600);
$res = setcookie("id", '', time()-3600, "/");


echo 'logout';

?>