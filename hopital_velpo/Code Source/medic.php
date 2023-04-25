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

    <nav class="navbar navbar-expand-lg bg-warning navbar-light">
      <div class="container-fluid">
        <div class="navbar-header">
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav" >
          <li class="nav-item"><a href="hopital.php" class="nav-link text-danger">Accueil</a></li>
          <li class="nav-item"><a href="patient.php" class="nav-link text-danger">Patients</a></li>
          <li class="nav-item"><a href="medic.php" style="background-color:#343A40;" class="nav-link text-danger">Corps Soignant</a></li>
          <li class="nav-item"><a href="operation.php" class="nav-link text-danger">Opérations</a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link text-danger">Nous Contacter</a> </li>
          </ul>
        </div>
      </div>
     </nav>

 <!-- Contenu exclusif de la page des médecins -->
     <div>
     <div style="margin:auto;margin-top:25px;">

 <!-- Barres de recherche -->
 <div class='container-fluid' style="border;width:550px;">
 <h2> Découvrez notre corps soignant ! </h2>
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
              <input type='text' name='docname' class='form-control' />
             </div>
             <div class='form-group mb-2'>
              <button class='btn btn-secondary form-control' type="submit" name="byspec"> Rechercher par spécialité</button>
             </div>
             <div class='form-group mb-2'>
               <input type='text' name='spec' class='form-control' />
             </div>
           </form>
       </div>

<!-- Bloc d'affiache de la liste de recherche -->
     <div>
<!-- Affichage de la liste de tous les médecins -->
       <?php
       if(isset($_POST['all'])){
       $tabDoc = getAllDoc();
       if($tabDoc){

       ?>
       <table class='table'>
       <?php
       foreach($tabDoc as $key=>$value){
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

 <!-- Affichage de la liste des médecins par nom -->
 <?php
 if(isset($_POST['byname'])){
 	$docname=$_POST['docname'];
 	$tabDocBydocname = getDocByDocname($docname);

 if($tabDocBydocname){

 ?>
 <table class='table'>
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

 <!-- Affichage des médecins par leur spécialité -->
 <?php
 if(isset($_POST['byspec'])&&isset($_POST['spec'])){
 	$spec=$_POST['spec'];
 		$tabDocByspec = getDocBySpec($spec);
 if($tabDocByspec){

 ?>
 <table class='table'>
 <?php
 foreach($tabDocByspec as $key=>$value){
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

  </body>

  <footer>
  </footer>
</html>
