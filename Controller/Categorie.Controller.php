<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['Views'])) {
        if ($_GET['Views'] == 'lister'){
            $page=1;
            if(isset($_GET['page'])){
            $page = intval($_GET['page']);
            }
                $id = $_SESSION['idp'];
                $datass = find_all_Categorie_ById($id);
                  $datas=paginnation($datass,$page,4);      
                  $nombrepage=get_nombre_page($datass,4);
            require(ROUTE_DIR . 'Views/Categorie/lister.html.php');
        } elseif ($_GET['Views'] == "add") {
            $_SESSION['idp'] = $_GET['id']; 
            require(ROUTE_DIR . 'Views/Categorie/add.html.php');
        } elseif ($_GET['Views'] == "Archiver"){
            $id = $_GET['id'];
            $Categorie = recup_projetA($id);
            require(ROUTE_DIR . 'Views/Projet/lister.html.php');
        }elseif ($_GET['Views'] == "Modification") {
            $id = $_GET['id'];
            $Categorie = recup_projetM($id);
            require(ROUTE_DIR . 'Views/Categorie/add.html.php');
        }elseif ($_GET['Views'] == "Filtrer") {
            $page=1;
            if(isset($_GET['page'])){
            $page = intval($_GET['page']);
            }
                  $datass = show();   
                  $datas=paginnation($datass,$page,4);      
                  $nombrepage=get_nombre_page($datass,4);
            require(ROUTE_DIR . 'Views/Categorie/lister.html.php');
        }

    }
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add'){
           Ajouter_Categorie($_POST);
        }elseif ($_POST['action'] == 'Modification') {
            Modifier_Categorie($_POST);
        } 
    }
}
function show():array{
    $id = $_SESSION['idp'];
    $kiki = "";
    if(isset($_GET['executer'])){
        $kiki = $_GET['recherche'];
    }
    $datas = [];
    $kikis = find_all_Categorie_ById($id);
    foreach ($kikis as  $value) {
         if (strrchr($value['libellec'],$kiki)!=null) {
               $datas []=$value;
         }
    }
    return $datas;
    header('location:'.WEB_ROUTE.'?Controller=Categorie&Views=lister');
}



function Ajouter_Categorie(array $data):void{ 
   $arrayError=array();
   extract($data);
   valide_champs($arrayError,'libellec',$libellec);
   if (form_valid($arrayError)){
      $etatc=1;
      $idp = $_SESSION['idp'];
     $dati=[
         $libellec,
         $idp,
         $etatc
        ];
        
          $result=insert_Categorie($dati);
         if($result){
            $_SESSION['succes_operation'] = "votre projet a été ajouter avec suceces";
            header('location:'.WEB_ROUTE.'?Controller=Categorie&Views=lister');
            exit();
            }if(!$result){
            $_SESSION['error_operation'] = "L'ajout de cette projet a échoué ";
            header('location:'.WEB_ROUTE.'?Controller=Categorie&Views=add');
            exit();
            }
        }else{
            $id = $_SESSION['idp'];
           // var_dump($id);die;
            $_SESSION['arrayError']=$arrayError;
            header('location:'.WEB_ROUTE.'?Controller=Categorie&Views=add&id=' .$id);
            exit();
            }
      }

      function Modifier_Categorie(array $data):void{
        $arrayError=array();
        extract($data);
        valide_libelle($arrayError,'libellec',$libellec);
        if (form_valid($arrayError)){
               $result=update_Categorie($idc,$libellec);
              // var_dump($result);die;
              if($result){
                 $_SESSION['succes_operation'] = "votre projet a été bien modifier avec succes";
                 header('location:'.WEB_ROUTE.'?Controller=Categorie&Views=lister');
                 exit();
                 }if(!$result){
                 $_SESSION['error_operation'] = "La modification de cette projet a échoué ";
                 header('location:'.WEB_ROUTE.'?Controller=Categorie&Views=add');
                 exit();
                 }
             }else{
                 $_SESSION['arrayError']=$arrayError;
                 header('location:'.WEB_ROUTE.'?Controller=Categorie&Views=add');
                 exit();
                 }
           }
           function recup_projetM(string $id):array{
            $categories=find_all_Categorie();
          foreach ($categories as $categorie){
                if ($categorie['idc']==$id){
                   return $categorie;
                }
           }
            return [];
          }
          function recup_projetA(string $id):array{
            $categories=find_all_Categorie();
          foreach  ($categories as $categorie){
                if ($categorie['idc']==$id){
                   if ($categorie['etatc']==1) {
                       $categorie['etatc'] = 0;
                       return archivedCategorie($categorie);
                   }
                }
           }
            return [];
          }

          function archivedCategorie(array $newprojet){
                   extract($newprojet);
                   archive_Categorie($idc,$etatc);
                   header('location:'.WEB_ROUTE.'?Controller=Categorie&Views=lister');
          }
