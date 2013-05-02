<?php
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];

function pg_connection_string_from_database_url() {
  extract(parse_url($_ENV["HEROKU_POSTGRESQL_YELLOW_URL"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); # <- you may want to add sslmode=require there too
}

$pg_conn = pg_connect(pg_connection_string_from_database_url());

echo $pg_con;
# Now let's use the connection for something silly just to prove it works:
$result = pg_query($pg_conn, "select un from t18982 where un ilike '$username'");

if (!pg_num_rows($result)) {
  $result = pg_query($pg_conn, "insert into t18982 values('$username','$password','$email'");
  print("Successfully registered. Please <a href=\"index.php\">Login</a>");
} else {
  
  print "Username already exists. Please select a different username. <a href=\"register.php\">Register</a>";
//while ($row = pg_fetch_row($result)) { print("- $row[0]\n"); }
}

?>
