<?php
  require("tables.php");
?>

<html>
  <head>
    <?php
    session_start();
    ?>

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
          <li class="nav-item"><a href="patient.php" style="background-color:#343A40;" class="nav-link text-danger">Patients</a></li>
          <li class="nav-item"><a href="medic.php" class="nav-link text-danger">Corps Soignant</a></li>
          <li class="nav-item"><a href="operation.php" class="nav-link text-danger">Opérations</a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link text-danger">Nous Contacter</a> </li>
          </ul>
        </div>
      </div>
     </nav>

<!-- Contenu exclusif de la page des patients -->
    <div>
      <div style="margin:auto;margin-top:25px;">

  <!-- Barres de recherche -->
  <div class='container-fluid' style="border;width:550px;">
  <h2> Renseignez vous sur vos proches ! </h2>
  <p> Entrez leur nom ou leur numéro si vous disposez de ce dernier. </p>
</div>
        <div class='container-fluid' style="border;width:250px;">

           <form action="" method="post" class='form'>
              <div class='form-group mb-4'>
                <button class='btn btn-secondary form-control' type="submit" name="all"> Afficher tous</button>
              </div>
              <div class='form-group mb-2'>
                <button class='btn btn-secondary form-control' type="submit" name="byname"> Rechercher par nom</button>
              </div>
              <div class='form-group mb-4'>
               <input type='text' name='patname' class='form-control' />
              </div>
              <div class='form-group mb-2'>
               <button class='btn btn-secondary form-control' type="submit" name="bypatno"> Rechercher par n°</button>
              </div>
              <div class='form-group mb-2'>
                <input type='text' name='patno' class='form-control' />
              </div>
            </form>
        </div>

  <!-- Bloc d'affiache de la liste de recherche -->
        <div>
          <!-- Affichage de la liste de tous les patients -->
          <?php
          if(isset($_POST['all'])){
            $tabPat = getAllPat();
            if($tabPat){
          ?>
              <table class='table'>
              <thead>
                <th> N° </th>
                <th> Nom </th>
                <th> Situation </th>
                <th> Médecin attributé </th>
                <th> Date d'hospitalisation </th>
                <th> Téléphone </th>
                <th> Mail </th>
                <th> Chambre </th>
                <th></th>
              </thead>

              <?php
              foreach($tabPat as $key=>$value){
              	echo "<tr>";
              		foreach($value as $k=>$v){
              			echo "<td>$v</td>";
              		}
                  ?>
                  <!-- Ajout du boutton de supression de l'élement -->
                  <td><a class='btn btn-danger form-control' href='patientdel.php?patno=<?= $value["patno"]?>'> Supprimer </td>
                  <?php
              	echo "</tr>";
              }
              ?>
              </table>
              <?php
            }
            else{
            	?>
            	<span class='text-danger'> NO DATA FOUND </span>
        <?php
            }
          }
        ?>

      <!-- Affichage de la liste des patients par nom -->
      <?php
      if(isset($_POST['byname'])){
      	$patname=$_POST['patname'];
      	$tabPatByPatName = getPatByPatname($patname);
        if($tabPatByPatName){
          ?>
          <table class='table'>
            <thead>
              <th> N° </th>
              <th> Nom </th>
              <th> Situation </th>
              <th> Médecin attributé </th>
              <th> Date d'hospitalisation </th>
              <th> Téléphone </th>
              <th> Mail </th>
              <th> Chambre </th>
              <th></th>
            </thead>
          <?php
          foreach($tabPatByPatName as $key=>$value){
          	echo "<tr>";
          		foreach($value as $k=>$v){
          			echo "<td>$v</td>";
          		}
              ?>
              <td><a class='btn btn-danger form-control' href='patientdel.php?patno=<?= $value["patno"]?>'> Supprimer </td>
              <?php
          	echo "</tr>";
          }
          ?>
          </table>
          <?php
        }
        else{
        	?>
        	<span class='text-danger'> NO DATA FOUND </span>
        	<?php
        }
      }
      ?>

      <!-- Affichage des patients par leur numéro -->
      <?php
      if(isset($_POST['bypatno'])&&isset($_POST['patno'])){
      	$patno=$_POST['patno'];
      	$tabPatBypatno = getPatByPatno($patno);
        if($tabPatBypatno){
      ?>
        <table class='table'>
          <thead>
            <th> N° </th>
            <th> Nom </th>
            <th> Situation </th>
            <th> Médecin attributé </th>
            <th> Date d'hospitalisation </th>
            <th> Téléphone </th>
            <th> Mail </th>
            <th> Chambre </th>
            <th></th>
          </thead>
        <?php
        foreach($tabPatBypatno as $key=>$value){
        	echo "<tr>";
        		foreach($value as $k=>$v){
        			echo "<td>$v</td>";
        		}
            ?>
            <td><a class='btn btn-danger form-control' href='patientdel.php?patno=<?= $value["patno"]?>'> Supprimer </td>
            <?php
        	echo "</tr>";
        }
        ?>
        </table>
        <?php
        }
        else{
        	?>
        	<span class='text-danger'> NO DATA FOUND </span>
        	<?php
        }
      }
      ?>
          </div>
        </div>
      </div>

      <!-- Formulaire d'inscription d'un nouveau patient -->
      <div class='container-fluid' style="border:solid;width:500px;">
        <h2> Enregistrer un nouveau patient </h2>
         <form method="post" class='form'>
            <div class='form-group mb-2'>
             <input type='text' name='temppatname' placeholder="Nom" class='form-control' required/>
            </div>
            <div class='form-group mb-2'>
              <input type='text' name='tempphone' placeholder="Téléphone (ex: 01 23 45 67 89)" class='form-control' required/>
            </div>
            <div class='form-group mb-2'>
              <input type='text' name='tempmail' placeholder="Adresse mail" class='form-control' required/>
            </div>

            <div>
            <!-- Droplist qui récupère toutes les maladies de la database -->
<?php
              $conn = new PDO("mysql:host=yqozyoncedricfou.mysql.db;dbname=yqozyoncedricfou","yqozyoncedricfou","Ingetis123");
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "SELECT * FROM maladies";
              $stmt = $conn->prepare($sql);
              $stmt->execute();
              $maladies = $stmt->fetchAll();?>
              <!-- Sélection d'une maladie -->
              <select class="form-select mb-2" name="selectedMaladie">
                  <?php foreach($maladies as $maladie):?>
                      <option value="<?= $maladie['sickness'];?>"><?= $maladie['sickness'];?></option>
                  <?php endforeach;?>
              </select>
            </div>

            <div class='form-group mb-2'>
             <button class='btn btn-secondary form-control' type="submit" name="newpat"> Valider </button>
            </div>
          </form>
        </div>

  </body>

<!-- Démarrage d'une session sur la page suivante pour finaliser l'inscription d'un nouveau patient-->
  <?php
if(isset($POST_['delpat'])){
  echo "<script> alert('boom'); </script>";
};

  if(isset($_POST['newpat'])){
  	$reponse =[$_POST['temppatname'],$_POST['tempmail'],$_POST['tempphone'],$_POST['selectedMaladie']];
  	$_SESSION['userInfo']=$reponse;
    echo "<script> window.location='patient2.php'</script>";
  }
  ?>

  <footer>
  </footer>
</html>
