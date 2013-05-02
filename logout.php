<?php
  session_start();
  if (isset($_SESSION['un']))
     unset($_SESSION['un']);

  session_destroy();
  header('Location: http://murmuring-inlet-9551.herokuapp.com/index.php');
?>
