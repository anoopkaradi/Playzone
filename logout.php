<?php
  session_start();
  session_unset();
  session_destroy();
echo "<html><script>window.location.href='MainPage.php';</script></html>";


?>