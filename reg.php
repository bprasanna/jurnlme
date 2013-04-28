<?php
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];

require_once "phar://iron_cache.phar";
$cache = new IronCache(array(
    'token' => 'Zn1zfHWzW0-CPRI5tQ3FjeIODMg',
    'project_id' => '517d29c4ed3d762654000241'
));

$res = $cache->put("username", $username);
$res = $cache->put("password", $password);
$res = $cache->put("username", $email);

?>
