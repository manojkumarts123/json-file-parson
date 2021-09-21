<?php 

  require_once "pdo.php";
  session_start();
  
  if(isset($_POST['submit'])){
    $filename = "files/". basename($_FILES["json"]["name"]);
    if(move_uploaded_file($_FILES["json"]['tmp_name'],$filename)){
      $content = file_get_contents($filename);
      $json = json_decode($content, true);
      if($json === null){ 
        $_SESSION["error"] = "The file is not a JSON";
        header( 'Location: upload.php' ) ;
        return;
      }
      foreach($json as $record){
        
        $userid = $record["userId"];
        $id = $record["id"];
        $title = $record["title"];
        $body = $record["body"];

        $st = $pdo->prepare("INSERT INTO data (id, userid, title, body) values (:id, :uid, :title, :body)");
        $st->execute(array(':id' => $id,
                           ':uid' => $userid,
                           ':title' => $title,
                           ':body' => $body));
      }
      $_SESSION["message"] = "The JSON file has successfully uploaded and updated the database";
      header( 'Location: upload.php' ) ;
      return;
    }else{
      $_SESSION["error"] = "Please upload JSON file";
      header( 'Location: upload.php') ;
      return;
    }
  }
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
          <?php include("include/navigation.html");?>
    </div>


    <?php
        if ( isset($_SESSION["error"]) ) {
            echo('<p style="color:red; margin-left:20px;">'.$_SESSION["error"]."</p>\n");
            unset($_SESSION["error"]);
        }
        if ( isset($_SESSION["message"]) ) {
            echo('<p style="color:green; margin-left:20px;">'.$_SESSION["message"]."</p>\n");
            unset($_SESSION["message"]);
        }
    ?>

    <div class='login_container'>
    <h1>Upload JSON file</h1>
      <form method="post" enctype="multipart/form-data">
        Select JSON file to upload:<br>
        <input type="file" class="login_input"name="json" id="json">
        <input type="submit" class="greenbutton upload" value="Upload JSON" name="submit">
      </form>
    </div>
  </body>
</html>