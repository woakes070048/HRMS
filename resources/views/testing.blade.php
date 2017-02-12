<!DOCTYPE html>
<html>

  <body>
    <?php 

      $month = 9;

      $formet = "+$month month";

      echo date("Y-m-d", strtotime("+12 month"))."<br>--<br>";
      echo date("Y-m-d", strtotime($formet));

    ?>
  </body>

</html>
