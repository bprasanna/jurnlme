<?php
session_start();
$un = '';
if(isset($_SESSION['un'])) {
    $un = $_SESSION['un'];
  } else {
    header('Location: http://murmuring-inlet-9551.herokuapp.com/index.php');
  }
$uid = 0;
function pg_connection_string_from_database_url() {
  extract(parse_url($_ENV["HEROKU_POSTGRESQL_YELLOW_URL"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); 
}

$pg_conn = pg_connect(pg_connection_string_from_database_url());

$result = pg_query($pg_conn, "select id from t18982 where un='$un'");

if (!pg_num_rows($result)) {
  print("Invalid Credentials. Please <a href=\"index.php\">Login</a> again");
} else {
  while ($row = pg_fetch_row($result)) { $uid = $row[0]; }
}

if ($uid != 0) {
   $notes = $_POST["notes"]; 
   $result = pg_query($pg_conn, "insert into j20111988(je, uid) values('$notes', $uid)");
   header('Location: http://murmuring-inlet-9551.herokuapp.com/home.php');
} 

pg_close($pg_conn);

?>
