<?php
  if(!isset($_SESSION['un'])) {
    header('Location: http://murmuring-inlet-9551.herokuapp.com/index.php');
  } else {
    echo $_SESSION['un'];
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
<h3>jurnlme</h3>
<hr>
<form method="post" action="add.php">
<input type="textarea" name="notes" placeholder="Add your notes" /><br>
<input type="submit" value="Add" />
<a href="logout.php">Logout</a>
<hr>
<h4>Recently...</h4>
<?php
$usern = $_SESSION['un'];

function pg_connection_string_from_database_url() {
  extract(parse_url($_ENV["HEROKU_POSTGRESQL_YELLOW_URL"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); 
}

$pg_conn = pg_connect(pg_connection_string_from_database_url());

$result = pg_query($pg_conn, "select j.je from j20111988 j, t18982 u where t.uid=u.id and u.un='$usern' order by ts desc");

if (!pg_num_rows($result)) {
  print("No notes added yet.<br>Feel free add one anytime.");
} else {
   while ($row = pg_fetch_row($result)) { print("<br> $row[0] <br>"); }
}

pg_close($pg_conn);

?>
</form>
</body>
</html>
