<?php 

  require_once "pdo.php";
  session_start();

?>

<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <link rel="stylesheet" href="stylesheet.css">
  </head>
  <body>
    <!--Navigation-->

    <div class="head">
      <p class="logo">FINANCEPEER</p>
          <?php include('include/navigation.html');?>
    </div>

    <?php 
      $st = $pdo->prepare("SELECT * FROM data");
      $st->execute();
      $column = 0;
      $total = 0;
      while ($row = $st->fetch(PDO::FETCH_ASSOC)){
        if($column == 0){
          echo ("<div class='cart_page'><table border='1px' class='table'>");
          echo ("<tr><th class='unique_column'>S.No</th>");
          echo ("<th>UserID</th>");
          echo ("<th>Title</th>");
          echo ("<th>Body</th></tr>");
          $column =1;
        }
          echo("<tr><td>");
          echo($column++);
          echo("</td><td>");
          echo($row['userid']);
          echo("</td><td>");
          echo($row['title']);
          echo("</td><td>");
          echo($row['body']);
          echo("</td></tr>");
        }
        if($column == 0){
          echo("<p>Sorry, currently there is no information in the database");
        }
    ?>
  </body>
</html>