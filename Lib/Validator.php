<?php
function est_vide($valeur) {
  return empty($valeur);
}

function est_entier($valeur) {
  return is_numeric($valeur);
}

function valide_libelle(&$arrayError,string $key ,$valeur){
  if (est_vide(trim($valeur))) {
      $arrayError[$key] = "Champ obligatoire";
  }
}

function valide_champs(&$arrayError, string $key, $valeur) {
  if (est_vide(trim($valeur))) {
      $arrayError[$key] = "Champ obligatoire";
  } elseif(est_entier($valeur)){
      $arrayError[$key] = "Veuillez saisir une chaine de caractere";
   }
}


function valide_email_regex(&$arrayError , string $key,$valeur ){
  $pattern = "/@+\.+";
  if (est_vide(trim($valeur))) {
      $arrayError[$key] = "Champ obligatoire";
  } elseif(preg_match($pattern, $valeur) == 0) {
      $arrayError[$key] = "Veuillez saisir une adresse mail valide";
  }
}

function form_valid(&$arrayError):bool{
  if (count($arrayError)==0) {
      return true;
  }else{
    return false;
}
}
function valide_image(array $files,string $key,array &$arrayError,$target_file):void{
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 if($imageFileType != "jpg" && $imageFileType != "JPG" 
  && $imageFileType != "png" && $imageFileType != "PNG" 
  && $imageFileType != "jpeg" && $imageFileType != "JPEG"
   && $imageFileType != "gif" && $imageFileType != "GIF" ) {
    $arrayError[$key] = "Désolé,seuls les fichiers: JPG, JPEG, PNG & GIF sont autorisés.";
  }elseif ($files["image"]["size"] > 500000){
      $arrayError[$key] = "la tailee ne doit pas depasser 500kb.";
  }elseif (est_vide(trim($target_file))) {
      $arrayError[$key] = "Champ obligatoire";
}
}
