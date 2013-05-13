<?php
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];

function pg_connection_string_from_database_url() {
  extract(parse_url($_ENV["HEROKU_POSTGRESQL_YELLOW_URL"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); 
}

$pg_conn = pg_connect(pg_connection_string_from_database_url());

$result = pg_query($pg_conn, "select un from t18982 where un ilike '$username'");

if (!pg_num_rows($result)) {
  $result = pg_query($pg_conn, "insert into t18982(un,pa,em) values('$username','$password','$email')");
  if($result>0){
  echo "Successfully registered.";
  } else {
  echo "Username already exists. Please select a different username.";
  }
} else {
  echo "Username already exists. Please select a different username.";
}

pg_close($pg_conn);

?>
