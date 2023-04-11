<?php
  require("tables.php");
?>

<html>
</header>
  <body>
    <!-- Droplist qui récupère toutes les maladies de la database -->
    <?php
      $conn = new PDO("mysql:host=localhost;dbname=hopital_velpo","root","mysql");
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM maladies";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $maladies = $stmt->fetchAll();
    ?>

    <!-- Sélection d'une maladie -->
    <form method="post">
    <select name="selectedMaladie">
        <?php foreach($maladies as $maladie): ?>
            <option value="<?= $maladie['sickness']; ?>"><?= $maladie['sickness']; ?></option>
        <?php endforeach; ?>
    </select>
    <button name="valider" type="submit" value="valider"> Valider </button>
    </form>

    <!-- On récupère les médecins spécialisés dans la maladie sélectionnée -->
    <?php
      if (array_key_exists("valider", $_POST)){
        $maladie = $_POST['selectedMaladie'];
        $medecins = getDocBySpec($maladie);
      };
      ?>

    <!-- Sélection d'un médecin -->
    <select name="selectedDoc">
        <?php foreach($medecins as $medecin): ?>
            <option value='docname'> <?= $medecin['docname']; ?></option>
        <?php endforeach; ?>
    </select>

  </body>
</html>
