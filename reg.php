<?php
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];

require_once "phar://iron_cache.phar";
$cache = new IronCache(array(
    'token' => 'Zn1zfHWzW0-CPRI5tQ3FjeIODMg',
    'project_id' => '517d29c4ed3d762654000241'
));

$user = $cache->get("username");
if($user->value == $username) {
  echo "User already exists. Please use other username";
  header("Location: http://murmuring-inlet-9551.herokuapp.com/register.php"); /* Redirect browser */
  exit();
} else {
$res = $cache->put("username", $username);
$res = $cache->put("password", $password);
$res = $cache->put("email", $email);
echo "Successfully registered.<a href=\"index.php\">Login</a>";
}


?>
