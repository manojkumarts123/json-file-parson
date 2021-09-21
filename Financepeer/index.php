<?php
    require_once "pdo.php";
    session_start();

    if ( isset($_POST["email"]) && isset($_POST["password"]) ) {
        unset($_SESSION["user"]);  // Logout current user
        $sql = "SELECT * FROM users where email = :em";
        $st = $pdo->prepare($sql);
        $st->execute(array(
            ':em' => $_POST['email'])
        );

        $row = $st->fetch(PDO::FETCH_ASSOC);

        $name = $row['name'];
        $email = $row['email'];
        $pw = $row['password'];

        if ( $_POST['password'] == $pw && $_POST['email'] = $email) {
            $_SESSION["name"] = $row['name'];
          
            $_SESSION["user"] = $row['customer_id'];
            $_SESSION["success"] = "Logged in.";
            $_SESSION["message"] = "Hi ".$name."!!Logged in Successfully";
            header( 'Location: upload.php' ) ;
            return;
        } else {
            $_SESSION["error"] = "Incorrect email or password.";
            header( 'Location: index.php' ) ;
            return;
        }
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Json | Login</title>

    <link rel="stylesheet" href="stylesheet.css">

  </head>

  <body>
    <body class="login">
      <h1 class="heading" style="text-align: center;padding-top: 50px;">JSON file Parser</h1>
      <div class="login_container">
        <h2 style="text-align: center;">User | Login</h2>
        <?php
        if ( isset($_SESSION["error"]) ) {
            echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
            unset($_SESSION["error"]);
        }
        if ( isset($_SESSION["message"]) ) {
            echo('<p style="color:green">'.$_SESSION["message"]."</p>\n");
            unset($_SESSION["message"]);
        }
      ?>
        <form method="post">
          <input type='text' class='login_input' name='email' id='id' placeholder="Email"/><br><br>
          <input type='password' class='login_input' name='password' id='password' placeholder="Password"/><br><br>
          <input type='submit' class='greenbutton submit'> 
        </form>
      </div>
    </div>
  </body>
</html>


