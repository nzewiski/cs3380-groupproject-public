<?php
// //Connect
$host = '';
$user = '';
$password = '';
$db = '';
if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	$url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header('Location: ' . $url);
}
$link = mysqli_connect($host, $user, $password, $db); 
or die ("Database connection failed - " . mysqli_error($link));				