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
$jentry = $_POST["jentry"];
$jid = $_POST["jid"];

$pg_conn = pg_connect(pg_connection_string_from_database_url());

$result = pg_query($pg_conn, "update j20111988 set je='$jentry' where jid="$jid);

if (!pg_num_rows($result)) {
  print("failed");
} else {
   print ("success");
}

pg_close($pg_conn);

?>
