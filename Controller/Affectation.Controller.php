<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['Views'])) {
        if ($_GET['Views'] == 'lister') {
            $page=1;
            if(isset($_GET['page'])){
            $page = intval($_GET['page']);
            }
                $id = $_SESSION['idU'];
                $datass = find_all_Affectation_ById($id);
                  $datas=paginnation($datass,$page,3);      
                  $nombrepage=get_nombre_page($datass,3);
            require(ROUTE_DIR . 'Views/Affectation/lister.html.php');
        } elseif ($_GET['Views'] == "add"){
            $idp = $_SESSION['idp'];
            $datas = find_all_Tache_ByProjet($idp);
            $_SESSION['idU'] = $_GET['id'];
            require(ROUTE_DIR . 'Views/Affectation/add.html.php');
        } elseif ($_GET['Views'] == "Archiver"){
            $id = $_GET['id'];
            $Affectation = recup_projetA($id);
            require(ROUTE_DIR . 'Views/Affectation/lister.html.php');
        }elseif ($_GET['Views'] == "delete"){
            $id = $_GET['id'];
            foreach ($_SESSION['arrayTache'] as $key => $value) {
                if($value['idt'] == $id){
                    unset($_SESSION['arrayTache'][$key]);
                }
            }
            require(ROUTE_DIR . 'Views/Affectation/add.html.php');
        }
    }
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['action'])) {
        $id = $_SESSION['idU'];
        if ($_POST['action'] == 'add'){
            if(isset($_POST['choisir'])){
                $_SESSION['arraySelection'] = $_POST['idt'];
                header('location:' . WEB_ROUTE . '?Controller=Affectation&Views=add&id='.$id);
            }
                if(isset($_POST['ajouter'])){
                    $_SESSION['arraySelection'] = $_POST['idt'];
                    $_SESSION['arrayTache'];
                   if(!empty($_SESSION['arrayTache'])){
                    foreach ($_SESSION['arrayTache'] as $key => $value){
                        if ($value['idt'] == $_POST['idt']){
                                $idt = $_POST['idt'];
                                $nomt= $_POST['nomt'];
                                $dated= $_POST['dated'];
                                $datef= $_POST['datef'];
                            $membre = [
                                "idt" => $idt,
                                "nomt" => $nomt,
                                "dated" => $dated,
                                "datef" => $datef  
                            ];
                        unset($_SESSION['arrayTache'][$key]);
                       }else{
                                $idt = $_POST['idt'];
                                $nomt= $_POST['nomt'];
                                $dated= $_POST['dated'];
                                $datef= $_POST['datef'];
                            $membre = [
                                "idt" => $idt,
                                "nomt" => $nomt,
                                "dated" => $dated,
                                "datef" => $datef  
                            ];
                      }
                    }
                    
                   }else{
                            $idt = $_POST['idt'];
                            $nomt= $_POST['nomt'];
                            $dated= $_POST['dated'];
                            $datef= $_POST['datef'];
                        $membre = [
                            "idt" => $idt,
                            "nomt" => $nomt,
                            "dated" => $dated,
                            "datef" => $datef  
                        ];
                   }    
                    $_SESSION['arrayTache'][] = $membre;
                    header('location:' . WEB_ROUTE . '?Controller=Affectation&Views=add&id='.$id);
                 }
            if(isset($_POST['enregistrer'])){
                 Ajouter_Affectation($_POST) ;
              }
        } 
    }
} 

function Ajouter_Affectation($data):void{   
   $arrayError=array();
   extract($data);
if (form_valid($arrayError)) {
      $idp = $_SESSION['idp'];
      $datasss = find_all_Tache_ByProjet($idp);
    foreach ($_SESSION['arrayTache'] as $key => $value) {
        $etataf=1;
        $idU = $_SESSION['idU'];
        $idt = $value['idt'];
        $nomt = $value['nomt'];
        $dated = $value['dated'];
        $datef = $value['datef'];
        foreach ($datasss as $key => $value1) {
              if ($value1['idt'] == $value['idt']) {
                       if($value1['deja_affecter'] == 0){
                          $value1['deja_affecter'] = 1;
                          alerte_Tache($value1['idt'],$value1['deja_affecter']);
                       }
              }
        }
        $dati=[
            $idU,
            $idt,
            $nomt,
            $dated,
            $datef,
            $etataf
           ];
        insert_Affectation($dati);
    }
    header('location:'.WEB_ROUTE.'?Controller=Affectation&Views=lister');
    unset($_SESSION['arrayTache']);
    exit();
 }
           
}
          function recup_projetA(string $id):array{
            $affectations=find_all_Affectation();
          foreach($affectations as $affectation){
                if ($affectation['idaf']==$id){
                   if ($affectation['etataf']==1){
                       $affectation['etataf'] = 0;
                       return archivedAffectation($affectation);
                    }
                }
            }
            return [];
          }
          function archivedAffectation(array $newprojet){
                   extract($newprojet);
                   archive_Affectation($idaf,$etataf);
                   header('location:'.WEB_ROUTE.'?Controller=Affectation&Views=lister');
            }