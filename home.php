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
margin:5px;
padding:5px;
overflow:hidden;
}
</style>
<link rel="stylesheet" type="text/css" media="all" href="decor.css" />
<link rel="stylesheet" type="text/css" media="only screen and (max-width: 800px)" href="mob.css">
<style>
body { margin: 5px; }
</style>
<script type="text/javascript">
var edic;
function onf(id){
 edic = document.getElementById(id).innerHTML;
}

function ono(id){
edic2 = document.getElementById(id).innerHTML;
if(edic===edic2) {
} else {
alert("update:"+edic2);
}
}
function del(id){
alert('Gonna delete: '+id);
}

</script>
</head>
<body>
<span style="font-style:normal;font-weight:bold;font-size:16px"><?php print("$usern"); ?></span>
<hr>
<form method="post" action="add.php">
<textarea rows="5" cols="36" name="notes" placeholder="Add your notes"></textarea><br>
<input type="submit" value="Add" />
<a href="logout.php">Logout</a>
<hr>
<h4>Recently...</h4>
<?php

function pg_connection_string_from_database_url() {
  extract(parse_url($_ENV["HEROKU_POSTGRESQL_YELLOW_URL"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); 
}

$pg_conn = pg_connect(pg_connection_string_from_database_url());

$result = pg_query($pg_conn, "select j.jid, j.je from j20111988 j, t18982 u where j.uid=u.id and u.un='$usern' order by ts desc");

if (!pg_num_rows($result)) {
  print("No notes added yet.<br>Feel free to add one anytime.");
} else {
   print ("<article>");
   while ($row = pg_fetch_row($result)) { print("<section onclick=\"onf(this.id)\" id=$row[0] contenteditable=true onblur=\"ono(this.id)\">$row[1] </section>"); }
   print ("</article>");
}

pg_close($pg_conn);

?>
</form>
</body>
</html>
