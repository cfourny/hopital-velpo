<?php
  require("tables.php");
?>

<html>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>

      header{
        max-width:1400px;
        margin:auto;
      }

    </style>
  </head>

  <header>
    <div class="row" style="background-image:url(img/hopital2.png);background-repeat:no-repeat;background-position:center;background-size:100%;">
      <div class="col-sm">
      </div>
      <div class="col-sm">
      </div>
      <div class="col-sm" style="margin-top:50px;margin-bottom:50px;" >
        <div>
          <img src="img/title.png" height=150px widght=110px>
        </div>
      </div>
    </div>
  </header>

  <body>

<!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg bg-warning navbar-light">
      <div class="container-fluid">
        <div class="navbar-header">
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav" >
          <li class="nav-item"><a href="hopital.php" class="nav-link text-danger">Accueil</a></li>
          <li class="nav-item"><a href="patient.php" class="nav-link text-danger">Patients</a></li>
          <li class="nav-item"><a href="medic.php" class="nav-link text-danger">Corps Soignant</a></li>
          <li class="nav-item"><a href="operation.php" style="background-color:#343A40;" class="nav-link text-danger">Opérations</a></li>
          <li class="nav-item"><a href="operation_archivee.php" class="nav-link text-danger">Archive</a> </li>
          <li class="nav-item"><a href="contact.php" class="nav-link text-danger">Nous Contacter</a> </li>
          </ul>
        </div>
      </div>
     </nav>

<!-- Contenu exclusif de la page des opérations -->
    <?php
    if (isset($_GET['opno'])){
      $opnodel = $_GET['opno'];
    }
    ?>

    <div class='container-fluid mb-2' style=";width:850px;">
      <h3> L'opération n° <?= $opnodel ?> a été archivée. </h3>
      <a href="operation.php" class="btn btn-secondary form-control"> Retour à la page des opérations</a>
    </div>

  </body>
  <!-- Suppression de l'opération dans la base de données -->
  <?php
  $conn = new PDO("mysql:host=yqozyoncedricfou.mysql.db;dbname=yqozyoncedricfou","yqozyoncedricfou","Ingetis123");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM operation WHERE opno='$opnodel'";
    $conn->exec($sql);
  ?>

  <footer>
  </footer>
</html>
