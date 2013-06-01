<?php
  session_start();
  if (isset($_SESSION['un'])) {
     header('Location: http://murmuring-inlet-9551.herokuapp.com/home.php');
  } 
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" itemscope itemtype="http://schema.org/Article">
<head>
<title>Welcome</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=yes">
<link rel="stylesheet" type="text/css" media="all" href="decor.css" />
<link rel="stylesheet" type="text/css" media="only screen and (max-width: 800px)" href="mob.css">
</head>
<body>
<span style="font-style:normal;font-weight:bold;font-size:16px">Login</span>
<hr>
<input type="text" id="username" placeholder="Username" /><br>
<input type="password" id="password" placeholder="Password" /><br>
<input type="submit" value="Login" onClick="return authenticate()"/>
<div id="notifications"></div>
<a href="register.php">Register</a>
<p color="#333333">
Jurnl.Me is a light weight web application which is aimed to be a anytime jouranl notes taker.

</p>
<script src="controller.js"></script>
</body>
</html>
