<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['Views'])) {
        if ($_GET['Views'] == 'ListerProjet') {
            $page=1;
            if(isset($_GET['page'])){
            $page = intval($_GET['page']);
            }
                $id = $_SESSION['userConnect']['idU'];
                $datass = find_all_Projet_ById($id);   
                  $datas=paginnation($datass,$page,4);      
                  $nombrepage=get_nombre_page($datass,4);
            require(ROUTE_DIR . 'Views/Projet/ListerProjet.html.php');
        } elseif ($_GET['Views'] == "AddProjet") {
            require(ROUTE_DIR . 'Views/Projet/AddProjet.html.php');
        } elseif ($_GET['Views'] == "Archiver"){
            $id = $_GET['id'];
            $projet = recup_projetA($id);
            require(ROUTE_DIR . 'Views/Projet/ListerProjet.html.php');
        }elseif ($_GET['Views'] == "Modification") {
            $id = $_GET['id'];
            $projet = recup_projetM($id);
            require(ROUTE_DIR . 'Views/Projet/AddProjet.html.php');
        }elseif ($_GET['Views'] == "Filtrer") {
            $page=1;
            if(isset($_GET['page'])){
            $page = intval($_GET['page']);
            }
                $id = $_SESSION['userConnect']['idU'];
                  $datass = show();   
                  $datas=paginnation($datass,$page,4);      
                  $nombrepage=get_nombre_page($datass,4);
            require(ROUTE_DIR . 'Views/Projet/ListerProjet.html.php');
        }

    }
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'AddProjet'){
           Ajouter_Projet($_POST);
        }elseif ($_POST['action'] == 'Modification') {
            Modifier_Projet($_POST);
        } 
    }
}
function show():array{
    $id = $_SESSION['userConnect']['idU'];
    $kiki = "";
    if(isset($_GET['executer'])){
        $kiki = $_GET['recherche'];
    }
    $datas = [];
    $kikis = find_all_Projet_ById($id);
    foreach ($kikis as  $value) {
         if (strrchr($value['nomp'],$kiki)!=null) {
               $datas[] = $value;
         }
    }
    return $datas;
    header('location:'.WEB_ROUTE.'?Controller=Projet&Views=ListerProjet');

}



function Ajouter_Projet(array $data):void{
    
   $arrayError=array();
   extract($data);
   valide_champs($arrayError,'nomp',$nomp);
   valide_champs($arrayError ,'descriptionp',$descriptionp);
   if (form_valid($arrayError)){
      $etatp=1;
      $idU = $_SESSION['userConnect']['idU'];
     $dati=[
         $nomp,
         $descriptionp,
         $etatp,
         $idU
        ];
          $result=insert_Projet($dati);
         if($result){
            $_SESSION['succes_operation'] = "votre projet a été ajouter avec suceces";
            header('location:'.WEB_ROUTE.'?Controller=Projet&Views=ListerProjet');
            exit();
            }if(!$result){
            $_SESSION['error_operation'] = "L'ajout de cette projet a échoué ";
            header('location:'.WEB_ROUTE.'?Controller=Projet&Views=AddProjet');
            exit();
            }
        }else{
            $_SESSION['arrayError']=$arrayError;
            header('location:'.WEB_ROUTE.'?Controller=Projet&Views=AddProjet');
            exit();
            }
      }

      function Modifier_Projet(array $data):void{
        $arrayError=array();
        extract($data);
        
        valide_libelle($arrayError,'nomp',$nomp);
        valide_libelle($arrayError ,'descriptionp',$descriptionp);
        
        if (form_valid($arrayError)){
          
               $result=update_projet($idp,$nomp,$descriptionp);
              if($result){
                 $_SESSION['succes_operation'] = "votre projet a été bien modifier avec succes";
                 header('location:'.WEB_ROUTE.'?Controller=Projet&Views=ListerProjet');
                 exit();
                 }if(!$result){
                 $_SESSION['error_operation'] = "La modification de cette projet a échoué ";
                 header('location:'.WEB_ROUTE.'?Controller=Projet&Views=AddProjet');
                 exit();
                 }
             }else{
                 $_SESSION['arrayError']=$arrayError;
                 header('location:'.WEB_ROUTE.'?Controller=Projet&Views=AddProjet');
                 exit();
                 }
           }
           function recup_projetM(string $id):array{
            $projets=find_all_projet();
          foreach ($projets as $projet){
                if ($projet['idp']==$id){
                   return $projet;
                }
           }
            return [];
          }
          function recup_projetA(string $id):array{
            $projets=find_all_projet();
          foreach ($projets as $projet){
                if ($projet['idp']==$id){
                   if ($projet['etatp']==1) {
                       $projet['etatp'] = 0;
                       return archivedProjet($projet);
                   }
                }
           }
            return [];
          }

          function archivedProjet(array $newprojet){
                   extract($newprojet);
                   archive_Projet($idp,$etatp);
                   header('location:'.WEB_ROUTE.'?Controller=Projet&Views=ListerProjet');
          }
