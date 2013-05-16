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
    header('Location: http://murmuring-inlet-9551.herokuapp.com/index.php');
} else {
  while ($row = pg_fetch_row($result)) { $uid = $row[0]; }
}

if ($uid != 0) {
   $notes = pg_escape_string($_POST["notes"]); 
   $result = pg_query($pg_conn, "insert into j20111988(je, uid) values('$notes', $uid)");
   if(!$result) {
        echo "failed";
        } else {
            $res2 = pg_query($pg_conn, "select jid, je, to_char(ts+'5 hours'::interval+'30 minutes'::interval,'DD-Mon-YYYY'), to_char(ts+'5 hours'::interval+'30 minutes'::interval, 'HH12:MI:SS AM') from j20111988 where uid='$uid' order by ts desc limit 2");
            if (pg_num_rows($res2)) {
               $pd = "";
               $count = 0;
               while ($row = pg_fetch_row($res2)) { 
                  if ($count == 0) {
                     $out = $out."&nbsp;<span style=\"color:gray\">$row[3]</span>";
                     $out = $out. "<section onclick=\"onf(this.id)\" id=$row[0] contenteditable=true onblur=\"ono(this.id)\">$row[1] </section>"; 
                  }
                  if ($row[2] != $pd && $count == 1){
                      $out = "&nbsp;<b>$pd</b><br>".$out;
                  }
                  $pd = $row[2];
                  $count = 1;
            }
            echo $out;
          }
        }
} 

pg_close($pg_conn);

?>


