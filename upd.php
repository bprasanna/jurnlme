<?php
  session_start();
  if (isset($_SESSION['un'])) {
     $usern = $_SESSION['un'];
  } else {
     header('Location: http://murmuring-inlet-9551.herokuapp.com/index.php');
  }
?>
<?php

function pg_connection_string_from_database_url() {
  extract(parse_url($_ENV["HEROKU_POSTGRESQL_YELLOW_URL"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); 
}
$jentry = pg_escape_string($_POST["jentry"]);
$jid = $_POST["jid"];

$pg_conn = pg_connect(pg_connection_string_from_database_url());

$result = pg_query($pg_conn, "select id from t18982 where un='$usern'");

if (!pg_num_rows($result)) {
     header('Location: http://murmuring-inlet-9551.herokuapp.com/logout.php');
} else {
  while ($row = pg_fetch_row($result)) { $uid = $row[0]; }
}

if ($uid != 0) {
$pg_conn = pg_connect(pg_connection_string_from_database_url());

$result = pg_query($pg_conn, "update j20111988 set je='$jentry' where jid=$jid and uid=$uid");

if (!$result) {
   echo "Apologies. Failed to update.";
} else {
   echo "Updated successfully.";
}
}
pg_close($pg_conn);

?>
