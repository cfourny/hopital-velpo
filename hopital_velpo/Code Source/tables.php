<?php
//Fonction de connexion à la base de données
function connect(){
  try{
    $pdo = new PDO("mysql:host=yqozyoncedricfou.mysql.db;dbname=yqozyoncedricfou","yqozyoncedricfou","Ingetis123");
    return($pdo);
  }
  catch(Exeption $e){
    echo "Échec de connection à la base de donnée";
  }
}

//Fonction d'affichage de tous les éléments d'une table de la base de données
function getAll(){
  $link = connect();
  if(!link){
    echo "Un problème est survenu";
  }

  else{
    $req = "select * from  TABLE";
    $stmt = $link->prepare($req);
    $stmt->execute();
    if($stmt->rowCount()>0){
      $tab=$stmt->fetchAll(PDO::FETCH_ASSOC);
      return $tab;
    }
    else{
      return null;
    }
  }
}

//Fonction d'affichage des éléments par nom
function getByName($name){
  $link = connect();
  if(!link){
    echo "Un problème est survenu";
    }
  else{
      $name="%".$name."%";
    $req = "select * from TABLE where name like :term";
    $stmt = $linl->prepare($req);
    $stmt->bindParam(':term',$name,PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount()>0){
      $tab=$stmt->fetchAll(PDO::FETCH_ASSOC);

      return $tab;
    }
    else{
      return null;
    }
  }
}

//Fonction d'affichage des éléments par un attribut particulier
function getByATTRIBU($ATTRIBU){
  $link = connect();
  if(!link){
    echo "Un problème est survenu";
  }
  else{
    $req = "select * from TABLE where ATTRIBU=?";
    $stmt = $link->prepare($req);
    $stmt->execute(array($ATTRIBU));
    if($stmt->rowCount()>0){
      $tab=$stmt->fetchAll(PDO::FETCH_ASSOC);
      return $tab;
    }
    else{
      return null;
    }
  }
}

// --- FONCTIONS POUR PATIENTS --- //

//Fonction d'affichage de tous les patients
function getAllPat(){
  $link = connect();
  if(!$link){
    echo "Un problème est survenu";
  }

  else{
    $req = "select * from patients";
    $stmt = $link->prepare($req);
    $stmt->execute();
    if($stmt->rowCount()>0){
      $tab=$stmt->fetchAll(PDO::FETCH_ASSOC);
      return $tab;
    }
    else{
      return null;
    }
  }
}

//Fonction d'affichage des patients par nom
function getPatByPatname($patname){
  $link = connect();
  if(!$link){
    echo "Un problème est survenu";
    }
  else{
      $patname="%".$patname."%";
    $req = "select * from patients where patname like :term";
    $stmt = $link->prepare($req);
    $stmt->bindParam(':term',$patname,PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount()>0){
      $tab=$stmt->fetchAll(PDO::FETCH_ASSOC);

      return $tab;
    }
    else{
      return null;
    }
  }
}

//Fonction d'affichage des patients par leur numéro
function getPatByPatno($PATNO){
  $link = connect();
  if(!$link){
    echo "Un problème est survenu";
  }
  else{
    $req = "select * from patients where patno=?";
    $stmt = $link->prepare($req);
    $stmt->execute(array($PATNO));
    if($stmt->rowCount()>0){
      $tab=$stmt->fetchAll(PDO::FETCH_ASSOC);
      return $tab;
    }
    else{
      return null;
    }
  }
}

// --- FONCTIONS POUR MÉDECINS --- //

//Fonction d'affichage de tous les médecins
function getAllDoc(){
  $link = connect();
  if(!$link){
    echo "Un problème est survenu";
  }

  else{
    $req = "select * from medecins";
    $stmt = $link->prepare($req);
    $stmt->execute();
    if($stmt->rowCount()>0){
      $tab=$stmt->fetchAll(PDO::FETCH_ASSOC);
      return $tab;
    }
    else{
      return null;
    }
  }
}

//Fonction d'affichage des médecins par nom
function getDocByDocname($docname){
  $link = connect();
  if(!$link){
    echo "Un problème est survenu";
    }
  else{
      $docname="%".$docname."%";
    $req = "select * from medecins where docname like :term";
    $stmt = $link->prepare($req);
    $stmt->bindParam(':term',$docname,PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount()>0){
      $tab=$stmt->fetchAll(PDO::FETCH_ASSOC);

      return $tab;
    }
    else{
      return null;
    }
  }
}

//Fonction d'affichage des médecins par leur spécialité
function getDocBySpec($spec){
  $link = connect();
  if(!$link){
    echo "Un problème est survenu";
  }
  else{
    $req = "select * from medecins where spec=?";
    $stmt = $link->prepare($req);
    $stmt->execute(array($spec));
    if($stmt->rowCount()>0){
      $tab=$stmt->fetchAll(PDO::FETCH_ASSOC);
      return $tab;
    }
    else{
      return null;
    }
  }
}

// --- FONCTIONS POUR OPÉRATIONS --- //

//Fonction d'affichage de toutes les opérations
function getAllOp(){
  $link = connect();
  if(!$link){
    echo "Un problème est survenu";
  }

  else{
    $req = "select * from operation";
    $stmt = $link->prepare($req);
    $stmt->execute();
    if($stmt->rowCount()>0){
      $tab=$stmt->fetchAll(PDO::FETCH_ASSOC);
      return $tab;
    }
    else{
      return null;
    }
  }
}

//Fonction d'affichage des opérations par leur numéro
function getOpByOpno($opno){
  $link = connect();
  if(!$link){
    echo "Un problème est survenu";
  }
  else{
    $req = "select * from operation where opno=?";
    $stmt = $link->prepare($req);
    $stmt->execute(array($opno));
    if($stmt->rowCount()>0){
      $tab=$stmt->fetchAll(PDO::FETCH_ASSOC);
      return $tab;
    }
    else{
      return null;
    }
  }
}

//Fonction d'affichage des opérations en fonction du médecin attribué
function getOpByDocname($docname){
  $link = connect();
  if(!$link){
    echo "Un problème est survenu";
    }
  else{
      $docname="%".$docname."%";
    $req = "select * from operation where docname like :term";
    $stmt = $link->prepare($req);
    $stmt->bindParam(':term',$docname,PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount()>0){
      $tab=$stmt->fetchAll(PDO::FETCH_ASSOC);

      return $tab;
    }
    else{
      return null;
    }
  }
}

// ENTRAINEMENT E5 //
function getAllArchOp(){
  $link = connect();
  if(!$link){
    echo "Un problème est survenu";
  }

  else{
    $req = "select * from archive_op";
    $stmt = $link->prepare($req);
    $stmt->execute();
    if($stmt->rowCount()>0){
      $tab=$stmt->fetchAll(PDO::FETCH_ASSOC);
      return $tab;
    }
    else{
      return null;
    }
  }
}

//Fonction d'affichage des opérations par leur numéro
function getArchOpByOpno($opno){
  $link = connect();
  if(!$link){
    echo "Un problème est survenu";
  }
  else{
    $req = "select * from archive_op where opno=?";
    $stmt = $link->prepare($req);
    $stmt->execute(array($opno));
    if($stmt->rowCount()>0){
      $tab=$stmt->fetchAll(PDO::FETCH_ASSOC);
      return $tab;
    }
    else{
      return null;
    }
  }
}

//Fonction d'affichage des opérations en fonction du médecin attribué
function getArchOpByDocname($docname){
  $link = connect();
  if(!$link){
    echo "Un problème est survenu";
    }
  else{
      $docname="%".$docname."%";
    $req = "select * from archiveoperation where docname like :term";
    $stmt = $link->prepare($req);
    $stmt->bindParam(':term',$docname,PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount()>0){
      $tab=$stmt->fetchAll(PDO::FETCH_ASSOC);

      return $tab;
    }
    else{
      return null;
    }
  }
}


?>
