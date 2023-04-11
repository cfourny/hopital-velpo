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
    <?php
    session_start();
    ?>
<!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg bg-warning navbar-light">
      <div class="container-fluid">
        <div class="navbar-header">
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav" >
          <li class="nav-item"><a href="hopital.php" class="nav-link text-danger">Accueil</a></li>
          <li class="nav-item"><a href="patient.php" style="background-color:#343A40;" class="nav-link text-danger">Patients</a></li>
          <li class="nav-item"><a href="medic.php" class="nav-link text-danger">Corps Soignant</a></li>
          <li class="nav-item"><a href="operation.php" class="nav-link text-danger">Opérations</a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link text-danger">Nous Contacter</a> </li>
          </ul>
        </div>
      </div>
     </nav>

<!-- Contenu exclusif de la page de confirmation de l'enregistrement d'un patient -->


    <form class='container-fluid' style="width:850px;">
      <div>
        <h2> Patient enregistré ! </h2>
        <?php
        $patname = $_SESSION['userInfo'][0];
        $joindate = $_SESSION['userInfo'][3];
        $patno = $_SESSION['userInfo'][1];
        ?>
        <ul>
          <li> <?=  $patname." a été enregistré(e) le ".$joindate; ?> </li>
          <li> <?=  "Son identifiant est ".$patno; ?> </li>
        </ul>
      </div>
      <p> Vous pouvez à présent quitter cette page. </p>
    </div>

  </body>

  <?php
    session_unset();
  ?>

  <footer>
  </footer>
</html>
