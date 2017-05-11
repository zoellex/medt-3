<?php
  session_start();

  if(isset($_GET['check']))
        {
          echo "Eingaben Falsch!";
        }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset = "utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css"/>
  
  <title>Anmelden</title>
</head>
<body>
  <div class="wrapper">
    <?php
    if (!isset($_POST['submitBTN']))
    {
      ?>
      <h3><ins>Anmeldeinfos bitte eingeben:</ins></h3>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
          <div class="form-group">
            <label>User:</label>
            <input class="form-control" name="user" type="text">
          </div>

          <div class="form-group">
            <label>Passwort:</label>
            <input class="form-control" name="pw" type="text">
          </div>

          <button type="submit" class="btn btn-default btn-lg active" name="submitBTN">Anmelden</button>
        </form>
      <?php
    }
      if (isset($_POST['submitBTN']))
      {
        

        $bool = true;
        try
        {
          $host = 'localhost';
          $database = 'medt3';
          $user = $_POST['user'];
          $pwd = $_POST['pw'];
          $pdo = new PDO ("mysql:host=$host;dbname=$database", $user, $pwd);
        }catch(PDOException $e){
          $bool = false;
        }
        
        if($bool==true)
        {
            $_SESSION['user'] = $_POST['user'];
            $_SESSION['pw'] = $_POST['pw'];
            header("Location: http://127.0.0.1/medt/bsp4/index.php"); 
        }
        else
        {
            header("Location: http://127.0.0.1/medt/bsp4/login.php?check");
        }
      }
      ?>
  </div>
</body>
</html>