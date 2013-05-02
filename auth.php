<?php
$username = $_POST["username"];
$password = $_POST["password"];

function pg_connection_string_from_database_url() {
  extract(parse_url($_ENV["HEROKU_POSTGRESQL_YELLOW_URL"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); 
}

$pg_conn = pg_connect(pg_connection_string_from_database_url());

$result = pg_query($pg_conn, "select un from t18982 where un='$username' and pa='$password'");

if (!pg_num_rows($result)) {
  print("Invalid Credentials. Please <a href=\"index.php\">Login</a> again");
} else {
  session_start();
  $_SESSION['un'] = "'".$username."'";
  header('Location: http://murmuring-inlet-9551.herokuapp.com/home.php');
}

pg_close($pg_conn);

?>
