<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=yes">
<link rel="stylesheet" type="text/css" media="all" href="decor.css" />
<link rel="stylesheet" type="text/css" media="only screen and (max-width: 800px)" href="mob.css">
<script src="controller.js" type="text/javascript"></script>
</head>
<body>
<span style="font-style:normal;font-weight:bold;font-size:16px">Register</span>
<hr>
<form>
<input type="text" id="username" name="username" placeholder="Username" /><br>
<input type="password" id="password" name="password" placeholder="Password" /><br>
<input type="text" id="email" name="email" placeholder="Email" /><br>
<input type="button" value="Register" onclick="registeruser()"/>
<a href="index.php">Login</a>
</form>
<div id="notifications"></div>
</body>
</html>
