<?php
  require("tables.php");
?>

<html>
  <head>
  </head>

  <body>

    <?php
    $conn = new PDO("mysql:host=localhost;dbname=hopital_velpo","root","mysql");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_REQUEST['patname'], $_REQUEST['sickness'], $_REQUEST['docname'], $_REQUEST['phone'], $_REQUEST['mail'])){
      $patname = $_REQUEST['patname'];
      $sickness = $_REQUEST['sickness'];
      $docname = $_REQUEST['docname'];
      $phone = $_REQUEST['phone'];
      $mail = $_REQUEST['mail'];


      //$sql = "INSERT INTO 'patients' (patno, patname, sickness, phone, mail)
      //VALUES (,'$patname', '$sickness', '$phone', '$mail')";

      //$conn->exec($sql);
      //echo "<h3> Ajout réussi !</h3>";
      }
    else{
    ?>
    <!-- Formulaire de saisie -->
    <h3> Ajouter un nouveau patient </h3>
    <form>
      <input type="text" name="patname" placeholder="Nom du patient" required/>

      <!-- Droplist qui récupère toutes les maladies de la database -->
      <?php
      $sql = "SELECT * FROM maladies";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $maladies = $stmt->fetchAll();
      ?>
      <select>
          <?php foreach($maladies as $maladie): ?>
              <option value="sickness"><?= $maladie['sickness']; ?></option>
          <?php endforeach; ?>
      </select>

      <!-- Droplist qui récupère tous les médecins en fonction de la maladie choisie précédement -->
      <?php
      $sql2 = "SELECT spec FROM medecins WHERE spec=?";
      $stmt2 = $conn->prepare($sql2);
      $stmt2->execute(array($maladie));
      $medecins = $stmt2->fetchAll();
      ?>
      <select>
          <?php foreach($medecins as $medecin): ?>
              <option value="docname"><?= $medecin['sickness']; ?></option>
          <?php endforeach; ?>
      </select>

      <input type="text" name="phone" placeholder="N° de téléphone" required/>
      <input type="text" name="mail" placeholder="Adresse e-mail" required/>

      <input type="submit" name="submit"/>
    </form>
  <?php } ?>
  </body>



</html>
