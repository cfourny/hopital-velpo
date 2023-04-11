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
    <?php
    session_start();
    ?>
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
          <li class="nav-item"><a href="contact.php" class="nav-link text-danger">Nous Contacter</a> </li>
          </ul>
        </div>
      </div>
     </nav>

<!-- Contenu exclusif de la page des opérations -->
    <div class='container-fluid' style="margin:auto;margin-top:25px;width:1000px">
        <form method="post" class='form'>
          <div class="form-group mb-2">
          <!-- Filtrage des médecins en fonction de la maladie du patient -->
            <?php
            // On récupère le nom du patient, puis on récupère son numéro et sa maladie -->
                $patname = $_SESSION['userInfo'][0];

                $conn = new PDO("mysql:host=localhost;dbname=hopital_velpo","root","mysql");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $req = "select patno from patients where patname like :term";
                $stmt = $conn->prepare($req);
                $stmt->bindParam(':term',$patname,PDO::PARAM_STR);
                $stmt->execute();
                $patnofetch = $stmt->fetchAll();
                $patno = $patnofetch[0][0];

                $req = "select sickness from patients where patname like :term";
                $stmt = $conn->prepare($req);
                $stmt->bindParam(':term',$patname,PDO::PARAM_STR);
                $stmt->execute();
                $sicknessfetch = $stmt->fetchAll();
                $sickness = $sicknessfetch[0][0];
            ?>
            <h2> <?=$patname?>, enregistré avec le numéro <?=$patno?>, est hospitalé pour cause de <?=$sickness?>. </h2>
            </br>
            <!-- Filtrage des médecins en fonction de la maladie choisie -->
            <?php
              $medecins = getDocBySpec($sickness);
            ?>
            <!-- Menu déroulant de sélection des médecins -->
            <h4> Voici les médecins spécialisés disponibles </h4>
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
            $conn = new PDO("mysql:host=localhost;dbname=hopital_velpo","root","mysql");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM chambres";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $chambres = $stmt->fetchAll();
          ?>
          <!-- Choix du numéro de chambre d'hopital -->
            <h4> Choisissez la salle d'opération </h3>
            <select class="form-select mb-2" name="selectedRoom">
              <?php foreach($chambres as $chambre): ?>
                <option value= "<?=$chambre['roomno']?>"> <?= $chambre['roomno'] ?> </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group mb-2">
          <!-- Choix de la date d'opération -->
          <h4> Choisissez la date de l'opération </h4>
            <input type="date" name="opdate" value="2022-01-01" min="2022-01-01" max="2023-12-30">
          </div>
          <div class="form-group mb-2">
            <button class="btn btn-secondary form-control" type="submit" name="newop"> Terminer </button>
          </div>
        </form>
    </div>

  </body>
  <!-- Démarrage d'une session sur la page suivante pour finaliser la nouvelle opération -->
    <?php
    if(isset($_POST['newop'])){
      $opno = rand(1000,9999);
      $docname = $_POST['selectedDoc'];
      $roomno = $_POST['selectedRoom'];
      $date = $_POST['opdate'];

      $sql = "INSERT INTO operation (opno, docname, patno, roomno, date)
      VALUES ('$opno','$docname','$patno','$roomno','$date')";

      $conn->exec($sql);
    	$reponse =[$opno,$date];
    	$_SESSION['userInfo']=$reponse;
      echo "<script> window.location='operation3.php'</script>";
    };
    ?>

  <footer>
  </footer>
</html>
