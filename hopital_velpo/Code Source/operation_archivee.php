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
          <li class="nav-item"><a href="operation.php" class="nav-link text-danger">Opérations</a></li>
          <li class="nav-item"><a href="operation_archivee.php" style="background-color:#343A40;" class="nav-link text-danger">Archive</a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link text-danger">Nous Contacter</a> </li>
          </ul>
        </div>
      </div>
     </nav>

<!-- Contenu exclusif de la page des opérations -->
    <div>
    <div style="margin:auto;margin-top:25px;">

<!-- Barres de recherche -->
<div class='container-fluid' style="border;width:550px;">
<h2 class='text-center'> Archive des opérations </h2>
<p> </p>
</div>
      <div class='container-fluid' style="border;width:250px;">
         <form action="" method="post" class='form'>
            <div class='form-group mb-4'>
              <button class='btn btn-secondary form-control' type="submit" name="all"> Afficher tous</button>
            </div>
            <div class='form-group mb-2'>
              <button class='btn btn-secondary form-control' type="submit" name="byopno"> Rechercher par n°</button>
            </div>
            <div class='form-group mb-4'>
             <input type='text' name='opno' class='form-control' />
            </div>
            <div class='form-group mb-2'>
             <button class='btn btn-secondary form-control' type="submit" name="byname"> Rechercher par médecin</button>
            </div>
            <div class='form-group mb-2'>
              <input type='text' name='docname' class='form-control' />
            </div>
          </form>
      </div>

<!-- Bloc d'affiache de la liste de recherche -->
    <div>
      <!-- Les opérations sont par défaut affichées par ordre de date -->

      <!-- Affichage de la liste de toutes les opérations -->
      <?php
      if(isset($_POST['all'])){
      $tabPat = getAllArchOp();
      if($tabPat){

      ?>
      <table class='table'>
      <thead>
        <th> N° </th>
        <th> Médecin opérant </th>
        <th> N° du patient </th>
        <th> Salle d'opération </th>
        <th> Date de l'opération </th>
        <th></th>
      </thead>
      <?php
      foreach($tabPat as $key=>$value){
      	echo "<tr>";
      		foreach($value as $k=>$v){
      			echo "<td>$v</td>";
      		};


      	echo "</tr>";
      };
      ?>
      </table>

      <?php

      }
      else{
      	?>
      	<span class='text-danger'> NO DATA FOUND </span>

      	<?php
      };
    };
    ?>

  <!-- Affichage des opérations par leur numéro -->
  <?php
  if(isset($_POST['byopno'])&&isset($_POST['opno'])){
  	$opno=$_POST['opno'];
  		$tabOpbyOpno = getArchOpByOpno($opno);
  if($tabOpbyOpno){

  ?>
  <table class='table'>
  <thead>
    <th> N° </th>
    <th> Médecin opérant </th>
    <th> N° du patient </th>
    <th> Salle d'opération </th>
    <th> Date de l'opération </th>
    <th></th>
  </thead>
  <?php
  foreach($tabOpbyOpno as $key=>$value){
  	echo "<tr>";
  		foreach($value as $k=>$v){
  			echo "<td>$v</td>";
  		}


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

  <!-- Affichage des opérations en fonction du médecin attribué -->
  <?php
  if(isset($_POST['byname'])){
  	$docname=$_POST['docname'];
  	$tabDocBydocname = getArchOpByDocname($docname);

  if($tabDocBydocname){

  ?>
  <table class='table'>
  <thead>
    <th> N° </th>
    <th> Médecin opérant </th>
    <th> N° du patient </th>
    <th> Salle d'opération </th>
    <th> Date de l'opération </th>
    <th></th>
  </thead>
  <?php
  foreach($tabDocBydocname as $key=>$value){
  	echo "<tr>";
  		foreach($value as $k=>$v){
  			echo "<td>$v</td>";
  		}


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


  <footer>
  </footer>
</html>
