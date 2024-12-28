<?php
require_once "helper/Session.php";
Session::init();
define('ROOT', 'http://localhost/batch7am/event/');
define('BNO', 2);
define('TIME', 60);
require_once "helper/redirect.php";
require_once "helper/DB.php";
$module = "users";
$file = "index";
$uid = null;
$url = $_GET['url'] ?? null;
if ($url) {
    $url = explode('/', rtrim($url, '/'));
    $module = $url[0];
    $file = $url[1] ?? $file;
    $uid = $url[2] ?? null;
}
$path = "modules/$module/$file.php";

if (file_exists($path)) {
    if ($file != 'loaditem')
        include_once "header.php";
    include_once $path;
    if ($file != 'loaditem')
        include_once "footer.php";
} else {
    redirect('404.php');
}
