<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_GET['Views'])){
        if ($_GET['Views'] == 'add'){ 
            $datass = find_all_user();
            require(ROUTE_DIR . 'Views/Equipe/add.html.php');
         } elseif ($_GET['Views'] == "lister"){
            $page=1;
            if(isset($_GET['page'])){
            $page = intval($_GET['page']);
            }
                $datass = find_all_Equipe();   
                  $datas=paginnation($datass,$page,4);      
                  $nombrepage=get_nombre_page($datass,4);
            require(ROUTE_DIR . 'Views/Equipe/lister.html.php');
        }elseif ($_GET['Views'] == "Modification") {
            $id = $_GET['id'];
            $Equipe = recup_projetM($id);
            require(ROUTE_DIR . 'Views/Equipe/update.html.php');
         }elseif ($_GET['Views'] == "Archiver") {
            $id = $_GET['id'];
            $Equipe = Recup_projetA($id);
         } elseif ($_GET['Views'] == "detail"){
            $_SESSION['id'] = $_GET['id'];
            $page=1;
            if(isset($_GET['page'])){
            $page = intval($_GET['page']);
            }
                  $datass = find_all_EquipeUser($_SESSION['id']);  
                  $datas=paginnation($datass,$page,4);      
                  $nombrepage=get_nombre_page($datass,4);
            require(ROUTE_DIR . 'Views/Equipe/detail.html.php');
        }elseif ($_GET['Views'] == "Changed"){  
               $idkk = intval($_GET['id']);
              $detail = Recup_projetAA($idkk);
         }elseif ($_GET['Views'] == "Modification1") {
              $datass = find_all_user();
              $id = $_GET['id'];
              $Membre = recup_projetMM($id);
            require(ROUTE_DIR . 'Views/Equipe/update1.html.php');
         }elseif ($_GET['Views'] == "supprimer"){
               $id = $_GET['id'];
             foreach ($_SESSION['arrayMembre'] as $key => $value) {
                    if($value['idU'] == $id){
                      unset ($_SESSION['arrayMembre'][$key]);
                    }
             }
             require(ROUTE_DIR . 'Views/Equipe/add.html.php');
          }elseif ($_GET['Views'] == "rappelle"){
            $_SESSION['idUser'] = $_GET['id'];
            $page=1;
            if(isset($_GET['page'])){
            $page = intval($_GET['page']);
            }
                  $datass = find_all_rappelle_by_idmembre($_SESSION['idUser']);
                  $datas=paginnation($datass,$page,4);      
                  $nombrepage=get_nombre_page($datass,4); 
            require(ROUTE_DIR . 'Views/Equipe/rappelle.html.php');
          }
    }
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            if(isset($_POST['choisir'])){
                $_SESSION['arraySelection'] = $_POST['idU'];
                header('location:' . WEB_ROUTE . '?Controller=Equipe&Views=add');
            }
                if(isset($_POST['ajouter'])){
                  $_SESSION['arraySelection'] = $_POST['idU'];
                    $_SESSION['arrayMembre'];
                    if(!empty($_SESSION['arrayMembre'])){
                      foreach ($_SESSION['arrayMembre'] as $key => $value){
                        if ($value['idU'] == $_POST["idU"]){
                          $idU = $_POST['idU'];
                          $nomU= $_POST['nomU'];
                          $prenomU = $_POST['prenomU'];
                       $membre = [
                          "idU" => $idU,
                          "nomU" => $nomU,
                          "prenomU" => $prenomU
                         ];
                        unset($_SESSION['arrayMembre'][$key]);
                        }else {
                          $idU = $_POST['idU'];
                          $nomU= $_POST['nomU'];
                          $prenomU = $_POST['prenomU'];
                       $membre = [
                          "idU" => $idU,
                          "nomU" => $nomU,
                          "prenomU" => $prenomU
                        ];
                        }
                      }
                    }else{
                      $idU = $_POST['idU'];
                      $nomU= $_POST['nomU'];
                      $prenomU = $_POST['prenomU'];
                   $membre = [
                      "idU" => $idU,
                      "nomU" => $nomU,
                      "prenomU" => $prenomU
                    ];
                    }
                   
                    $_SESSION['arrayMembre'][] = $membre;
                    header('location:' . WEB_ROUTE . '?Controller=Equipe&Views=add');
                   
                 }
            if(isset($_POST['enregistrer'])){
                 Ajouter_Equipe($_POST) ;  
              }
        } elseif ($_POST['action'] == 'Modification'){
                 Modifier_Equipe($_POST);
        }elseif ($_POST['action'] == 'Modification1'){
            Modifier_Membre($_POST);
         }
    }
} 
function Ajouter_Equipe(array $data):void{
    $arrayError=array();
    extract($data);
    valide_champs($arrayError, 'nome', $nome);
    if (form_valid($arrayError)) {
        $etate=1;
        $idp = $_SESSION['idp'];
        $dati=[
            $nome,
            $idp,
            $etate
           ];
        $kiki=insert_Equipe($dati);
         $users = find_all_user();
        foreach ($_SESSION['arrayMembre'] as $value){
            $etatue=1;
            $ide = $kiki;
            foreach ($users as $key => $value1) {
                     if($value1['idU'] == $value['idU']) {
                           if ($value1['deja_inviter'] == 0){
                            $value1['deja_inviter'] = 1;
                            $value1["messagerie"] = "tu es inviter dans equipe .$nome. du projet numero.$idp";
                            Alerte_user($value1['idU'],$value1['messagerie'],$value1['deja_inviter']);
                           }
                     } 
            }
            $datii=[
                 $value['idU'],
                 $ide,
                 $value["nomU"],
                 $value["prenomU"],
                 $etatue
            ];
            $result1 = insert_Membre($datii);
        }
      
        header('location:'.WEB_ROUTE.'?Controller=Equipe&Views=lister');
       unset($_SESSION['arrayMembre']);
        exit();
    }else{
      $_SESSION['arrayError']=$arrayError;
      header('location:'.WEB_ROUTE.'?Controller=Equipe&Views=add');
      exit();
      }
}

       function Modifier_Equipe(array $data):void{
        $arrayError=array();
        extract($data);
        valide_libelle($arrayError,'nome',$nome);
        if (form_valid($arrayError)){
               $result=update_Equipe($ide,$nome);
              if($result){
                 $_SESSION['succes_operation'] = "votre equipe a été bien modifier avec succes";
                 header('location:'.WEB_ROUTE.'?Controller=Equipe&Views=lister');
                 exit();
                 }if(!$result){
                 $_SESSION['error_operation'] = "La modification de cette equipe a échoué ";
                 header('location:'.WEB_ROUTE.'?Controller=Equipe&Views=add');
                 exit();
                 }
             }else{
                 $_SESSION['arrayError']=$arrayError;
                 header('location:'.WEB_ROUTE.'?Controller=Equipe&Views=add');
                 exit();
                 }
           }
           function recup_projetM(string $id):array{
            $equipes=find_all_Equipe();
          foreach ($equipes as $equipe){
                if ($equipe['ide']==$id){
                   return $equipe;
                }
           }
            return [];
          }

          function Modifier_Membre(array $data):void{
            $id = $_SESSION['id'];
            $arrayError=array();
            extract($data);
            if (form_valid($arrayError)){
                   $result=update_Membre($idue,$idU);
                  if($result){
                     $_SESSION['succes_operation'] = "cette membre a été bien modifier avec succes";
                     header('location:'.WEB_ROUTE.'?Controller=Equipe&Views=detail&id='.$id);
                     exit();
                     }if(!$result){
                     $_SESSION['error_operation'] = "La modification de cet membre a échoué ";
                     header('location:'.WEB_ROUTE.'?Controller=Equipe&Views=detail&id='.$id);
                     exit();
                     }
                 }else{
                     $_SESSION['arrayError']=$arrayError;
                     header('location:'.WEB_ROUTE.'?Controller=Equipe&Views=detail&id='.$id);
                     exit();
                     }
               }

          function recup_projetMM(string $idkk):array{
            $id = $_SESSION['id'];
            $membres=find_all_EquipeUser($id);
          foreach ($membres as $membre){
                if ($membre['idue']==$idkk){
                   return $membre;
                }
           }
            return [];
          }
          function recup_projetA(string $id):array{
            
            $equipes=find_all_Equipe();
          foreach  ($equipes as $equipe){
                if ($equipe['ide']==$id){
                   if ($equipe['etate']==1) {
                       $equipe['etate'] = 0;
                       return archivedEquipe($equipe);
                   }
                }
           }
            return [];
          }

          function archivedEquipe(array $newprojet){
                   extract($newprojet);
                   archive_Equipe($ide,$etate);
                   header('location:'.WEB_ROUTE.'?Controller=Equipe&Views=lister');
          }

          function recup_projetAA(string $idkk):array{
            $id = $_SESSION['id'];
            $membres=find_all_EquipeUser($id);  
          foreach ($membres as $membre){
                if ($membre['idue']==$idkk){
                   if ($membre['etatue']==1) {
                       $membre['etatue'] = 0;
                       return archived_all($membre);
                   }
                }
           }
            return [];
          }
          function archived_all(array $membre){
            $idk = $_SESSION['id'];
            extract($membre);
            archive_Membre($idue,$etatue);
            header('location:'.WEB_ROUTE.'?Controller=Equipe&Views=detail&id='.$idk);
          }

          



