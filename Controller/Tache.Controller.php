<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['Views'])) {
        if ($_GET['Views'] == 'lister') {
            $page=1;
            if(isset($_GET['page'])){
            $page = intval($_GET['page']);
            }
                $id = $_SESSION['idc'];
                $datass = find_all_Tache_ById($id);  
                  $datas=paginnation($datass,$page,3);      
                  $nombrepage=get_nombre_page($datass,3);
            require(ROUTE_DIR . 'Views/Tache/lister.html.php');
        } elseif ($_GET['Views'] == "add") {
            $_SESSION['idc'] = $_GET['id'];
            require(ROUTE_DIR . 'Views/Tache/add.html.php');
        } elseif ($_GET['Views'] == "Archiver"){
            $id = $_GET['id'];
            $Tache = recup_projetA($id);
            require(ROUTE_DIR . 'Views/Tache/lister.html.php');
        }elseif ($_GET['Views'] == "Modification") {
            $idd = $_GET['id'];
            $Tache = recup_projetM($idd);
            require(ROUTE_DIR . 'Views/Tache/add.html.php');
        } elseif ($_GET['Views'] == "choice") {
            $idt = $_GET['id'];
            $_SESSION['idar'] = $idt;
            $id = $_SESSION['idp'];
            $datass = find_all_Categorie_ById($id);
            $Tache = recup_projetM($idt);
            require(ROUTE_DIR . 'Views/Tache/choice.html.php');
        }

    }
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add'){
           Ajouter_Tache($_POST,$_FILES);
        }elseif ($_POST['action'] == 'Modification') {
            Modifier_Tache($_POST,$_FILES);
        }elseif ($_POST['action'] == 'choice') {
            Ajouter2_Tache($_POST,$_FILES);
        }  
    }
}

function Ajouter_Tache($data,$files):void{   
   $arrayError=array();
   extract($data);
   valide_champs($arrayError,'nomt',$nomt);
   valide_libelle($arrayError,'dated',$dated);
   valide_libelle($arrayError,'datef',$datef);
  // valide_image($files,"photot",$arrayError,$photot);
   if (form_valid($arrayError)){
      $etatt=1;
      $idc = $_SESSION['idc'];
      $idp = $_SESSION['idp'];
      $deja_affecter = 0;
      $rappelle = "cc le rappelle existe";
     $dati=[
         $nomt,
         $dated,
         $datef,
         $files['photot']['name'],
         $idc,
         $etatt,
         $idp,
         $deja_affecter,
         $rappelle
        ];
        to_uploads($files,"photot");
          $result=insert_Tache($dati);
         if($result){
            $_SESSION['succes_operation'] = "votre projet a été ajouter avec suceces";
            header('location:'.WEB_ROUTE.'?Controller=Tache&Views=lister');
            exit();
            }if(!$result){
            $_SESSION['error_operation'] = "L'ajout de cette projet a échoué ";
            header('location:'.WEB_ROUTE.'?Controller=Tache&Views=add&id='.$_SESSION['idc']);
            exit();
            }
        }else{
            $_SESSION['arrayError']=$arrayError;
            header('location:'.WEB_ROUTE.'?Controller=Tache&Views=add&id='.$_SESSION['idc']);
            exit();
            }
      }


      function Ajouter2_Tache($data,$files):void{   
        $arrayError=array();
        extract($data);
        valide_champs($arrayError,'nomt',$nomt);
        valide_libelle($arrayError,'dated',$dated);
        valide_libelle($arrayError,'datef',$datef);
        if (form_valid($arrayError)){
           $etatt=1;
           $idc = $data['idc'];
           $idp = $_SESSION['idp'];
           $deja_affecter = 0;
           $rappelle = "cc le rappelle existe";
          $dati=[
              $nomt,
              $dated,
              $datef,
              $files['photot']['name'],
              $idc,
              $etatt,
              $idp,
              $deja_affecter,
              $rappelle
             ];
             
             to_uploads($files,"photot");
               $result=insert_Tache($dati);
              if($result){
                 $_SESSION['succes_operation'] = "votre projet a été ajouter avec suceces";
                 header('location:'.WEB_ROUTE.'?Controller=Tache&Views=lister&id='.$idc);
                 exit();
                 }if(!$result){
                 $_SESSION['error_operation'] = "L'ajout de cette projet a échoué ";
                 header('location:'.WEB_ROUTE.'?Controller=Tache&Views=add&id='.$_SESSION['idc']);
                 exit();
                 }
             }else{
                 $_SESSION['arrayError']=$arrayError;
                 header('location:'.WEB_ROUTE.'?Controller=Tache&Views=add&id='.$_SESSION['idc']);
                 exit();
                 }
           }

      function Modifier_Tache($data,$files):void{
        
        $arrayError=array();
        
        extract($data);
        valide_champs($arrayError,'nomt',$nomt);
        valide_libelle($arrayError,'dated',$dated);
        valide_libelle($arrayError,'datef',$datef);  
        if (form_valid($arrayError)){
            $idt = $data['idt'];
            $nomt = $data["nomt"];
            $dated = $data['dated'];
            $datef = $data['datef'];
            $photot = $files['photot']['name'];
              to_uploads($files,$photo);
               $result=update_Tache($idt,$nomt,$dated,$datef,$photot);
              if($result){
                 $_SESSION['succes_operation'] = "votre projet a été bien modifier avec succes";
                 header('location:'.WEB_ROUTE.'?Controller=Tache&Views=lister');
                 exit();
                 }if(!$result){
                 $_SESSION['error_operation'] = "La modification de cette projet a échoué ";
                 header('location:'.WEB_ROUTE.'?Controller=Tache&Views=add&id='.$_SESSION['idc']);
                 exit();
                 }
               }else{
                 $_SESSION['arrayError']=$arrayError;
                 header('location:'.WEB_ROUTE.'?Controller=Tache&Views=add&id='.$_SESSION['idc']);
                 exit();
                 }
           }
           function recup_projetM(string $id):array{
            $taches=find_all_Tache();
          foreach ($taches as $tache){
                if ($tache['idt']==$id){
                   return $tache;
                }
           }
               return [];
          }
          function recup_projetA(string $id):array{
            $taches=find_all_Tache();
          foreach($taches as $tache){
                if ($tache['idt']==$id){
                   if ($tache['etatt']==1) {
                       $tache['etatt'] = 0;
                       return archivedTache($tache);
                    }
                }
            }
            return [];
          }
          function archivedTache(array $newprojet){
                   extract($newprojet);
                   archive_Tache($idt,$etatt);
                   header('location:'.WEB_ROUTE.'?Controller=Tache&Views=lister');
            }    
