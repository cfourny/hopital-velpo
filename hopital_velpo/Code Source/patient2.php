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

<!-- Contenu exclusif de la page d'enregistrement des patients -->


    <div class='container-fluid' style="border:solid;width:850px;">
      <h2> Bonjour <?php echo $_SESSION['userInfo'][0]; ?> ! Veuillez remplir les champs ci-dessous. </h1>

      <form method="post" class='form'>
        <div class="form-group mb-2">
        <!-- Filtrage des médecins en fonction de la maladie choisie -->
          <?php
              $maladie = $_SESSION['userInfo'][3];
              $medecins = getDocBySpec($maladie);
          ?>
          <!-- Menu déroulant de sélection des médecins -->
          <h4> Voici les médecins disponibles </h3>
          <select class="form-select mb-2" name="selectedDoc">
              <?php foreach($medecins as $medecin): ?>
                  <option value=<?= $medecin['docname']; ?>> <?= $medecin['docname']; ?></option>
              <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group mb-2">
        <!-- Sélection de la chambre -->
        <!-- Récupération de toutes les chambres depuis la base de données -->
        <?php
          $conn = new PDO("mysql:host=yqozyoncedricfou.mysql.db;dbname=yqozyoncedricfou","yqozyoncedricfou","Ingetis123");
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "SELECT * FROM chambres";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $chambres = $stmt->fetchAll();
        ?>
        <!-- Chox du numéro de chambre d'hopital -->
          <h4> Choisissez une chambre </h4>
          <select class="form-select mb-2" name="selectedRoom">
            <?php foreach($chambres as $chambre): ?>
              <option value= "<?=$chambre['roomno']?>"> <?= $chambre['roomno'] ?> </option>
            <?php endforeach; ?>
          </select>
          <button class="btn btn-secondary form-control" type="submit" name="valider"> Terminer </button>
        </div>
      </form>
    </div>

  </body>
  <!-- Enregistrement du patient dans la Database et renvoi à la page de fin d'enregistrement -->
  <?php
  $conn = new PDO("mysql:host=yqozyoncedricfou.mysql.db;dbname=yqozyoncedricfou","yqozyoncedricfou","Ingetis123");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if(isset($_POST['valider'])){
    $patno =  rand(100000,999999);
    $patname = $_SESSION['userInfo'][0];
    $sickness = $_SESSION['userInfo'][3];
    $docname = $_POST['selectedDoc'];
    $joindate = date("Y-m-d");
    $phone = $_SESSION['userInfo'][2];
    $mail = $_SESSION['userInfo'][1];
    $roomno = $_POST['selectedRoom'];

    $sql = "INSERT INTO patients (patno, patname, sickness, docname, joindate, phone, mail, roomno)
    VALUES ('$patno', '$patname', '$sickness', '$docname', '$joindate', '$phone', '$mail', '$roomno')";

    $conn->exec($sql);
    $reponse=[$_SESSION['userInfo'][0],$patno,$docname,$joindate];
    $_SESSION['userInfo']=$reponse;
    echo "<script> window.location='patient3.php'</script>";
  }
  ?>
  <footer>
  </footer>
</html>
