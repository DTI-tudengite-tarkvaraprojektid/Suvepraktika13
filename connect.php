  $con = new mysqli($GLOBALS['host'], $GLOBALS['dbusername'], $GLOBALS['dbpassword'], $GLOBALS['database']); /* REPLACE NECESSARY DATA INSIDE */

  /* check connection */
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

?>