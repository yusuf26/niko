<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>LOGIN</title>
    <link href="assets/css/united-bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/signin.css" rel="stylesheet"/>
    <link rel="stylesheet" media="screen" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" media="screen" href="assets/css/bootstrap-admin-theme.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>      
  </head>

  <body>
    <div class="container">
      <form class="form-signin" action="?act=login" method="post">
         <h1>Login</h1>
            <h4>SPK Metode TOPSIS</h4>
            <center><img src="images/logo_1.png"/></center>        
        <?php if($_POST) include 'aksi.php'; ?>
        <label for="inputEmail" class="sr-only">Usernames</label>
        <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="user" autofocus />
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="pass" />        
        <button class="btn btn-lg btn-info btn-block" type="submit">Masuk</button>        
      </form>      
    </div>
</html>
