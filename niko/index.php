<?php
include'functions.php';
if(empty($_SESSION[login]))
    header("location:login.php"); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-32"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    

    <title>SPK PT. DS3I</title>
    <link href="assets/css/united-bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/general.css" rel="stylesheet"/>
    <link rel="stylesheet" media="screen" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" media="screen" href="assets/css/bootstrap-admin-theme.css">
     <link rel="stylesheet" media="screen" href="assets/daterangepicker/daterangepicker.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/daterangepicker/moment.min.js"></script>
    <script type="text/javascript"  src="assets/daterangepicker/daterangepicker.js"></script>           
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?">SPK-TOPSIS</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="?m=home"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
            <li><a href="?m=karyawan"><span class="glyphicon glyphicon-user"></span> Karyawan</a></li>
            <li><a href="?m=kriteria"><span class="glyphicon glyphicon-edit"></span> Kriteria</a></li>
            <!-- <li><a href="?m=nilai_karyawan"><span class="glyphicon glyphicon-menu-hamburger"></span> Penilaian Karyawan</a></li> -->     
            <li><a href="?m=periode"><span class="glyphicon glyphicon-tasks"></span> Penilaian Karyawan</a></li>
            <!-- <li><a href="?m=hitung"><span class="glyphicon glyphicon-calendar"></span> Laporan</a></li> -->
            <li><a href="?m=password"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
            <li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>                   
          </ul>          
          <div class="navbar-text"></div>
        </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container hentry">
    <?php
        if(file_exists($mod.'.php'))
            include $mod.'.php';
        else
            include 'home.php';
    ?>
    </div>
</body>
</html>