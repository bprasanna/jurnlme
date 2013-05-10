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

$pg_conn = pg_connect(pg_connection_string_from_database_url());

$result = pg_query($pg_conn, "select j.jid, j.je, to_char(j.ts,'DD-Mon-YYYY'), to_char(j.ts, 'HH24:MI:SS') from j20111988 j, t18982 u where j.uid=u.id and u.un='$usern' order by ts desc");
$out = "";

if (!pg_num_rows($result)) {
  $out = "No notes added yet.<br>Feel free to add one anytime.";
} else {
   $pd = "";
   $out = $out."<article>";
   while ($row = pg_fetch_row($result)) { 
         if (strcmp($row[2],$pd)>0){
            $pd = $row[2];
            $out = $out."<b>$pd</b><br>";
         }
         $out = $out."<span style=\"color:gray\">$row[3]</span>";
         $out = $out. "<section onclick=\"onf(this.id)\" id=$row[0] contenteditable=true onblur=\"ono(this.id)\">$row[1] </section>"; 
   }
   $out = $out."</article>";
}
echo $out;

pg_close($pg_conn);

?>
