<?php
  session_start();
  if (isset($_SESSION['un'])) {
     $usern = $_SESSION['un'];
  } else {
     header('Location: http://murmuring-inlet-9551.herokuapp.com/index.php');
  }
?>
<html>
<head>
<title>Welcome</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=yes">
<style>
section
{
border-style:solid;
border-width:1px;
border-color:gray;
margin-top:5px;
margin-right:5px;
margin-left:5px;
margin-bottom:15px;
padding:5px;
overflow:hidden;
}
</style>
<link rel="stylesheet" type="text/css" media="all" href="decor.css" />
<link rel="stylesheet" type="text/css" media="only screen and (max-width: 800px)" href="mob.css">
<style>
body { margin: 5px; }
</style>
<script src="controller.js" type="text/javascript"></script>
<script type="text/javascript">
var edic;
function onf(id){
 edic = document.getElementById(id).innerHTML;
}

function ono(id){
edic2 = document.getElementById(id).innerHTML;
if(edic===edic2) {
} else {
updateentry(id,edic2);
}
}
function del(id){
alert('Gonna delete: '+id);
}
</script>
</head>
<body onload="loadentries()">
<span style="font-style:normal;font-weight:bold;font-size:16px"><?php print("$usern"); ?></span>
<hr>
<form>
<textarea id="journalnotes" rows="5" cols="34" name="notes" placeholder="Add your notes"></textarea><br>
<input type="button" value="Add" onclick="addentry()"/>
<a href="logout.php">Logout</a>
</form>
<hr>
<div id="notifications"></div>
<h4>Recently...</h4>
<div id="entries"></div>
</body>
</html>
