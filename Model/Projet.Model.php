<?php
      function insert_Projet(array $data):int{
       
        $PDO=ouvrir_connexion_bd();
          $sql="INSERT INTO projet ( nomp,descriptionp,etatp,idU)
          VALUES (?,?,?,?)";
          $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          $sth->execute($data);
          $nbre_ligne_insert = $sth->rowCount();
          fermer_connexion_bd($PDO);
          return $nbre_ligne_insert;
       }
       function find_all_Projet_ById($idu):array{
        $PDO=ouvrir_connexion_bd();
          $sql="select * from projet where idU = ? and etatp = 1 order by(idp) desc ";
          $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          $sth->execute(array($idu));
          $data = $sth->fetchALL();
          fermer_connexion_bd($PDO);
          return $data;
        }
        function find_all_projet():array{
            $PDO=ouvrir_connexion_bd();
            $sql="select * from projet where etatp = 1 order by(idp) desc";
            $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();
            $data = $sth->fetchALL();
            fermer_connexion_bd($PDO);
            return $data;
         }

    
      function update_projet($idp,$nomp,$descriptionp):int{
        
        $PDO=ouvrir_connexion_bd();
        $sql="UPDATE `projet` SET nomp =?,descriptionp= ? where idp =? ";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array($nomp,$descriptionp,$idp));
        $nbre_ligne_insert = $sth->rowCount();
        fermer_connexion_bd($PDO);
        return $nbre_ligne_insert;

     };


      function archive_Projet($idp,$etatp):array{
        $PDO=ouvrir_connexion_bd();
        $sql="UPDATE `projet` SET etatp =? where idp =? ";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array($etatp,$idp));
        $tab = $sth->fetchALL();
        fermer_connexion_bd($PDO);
        return $tab;
      }

      function filtrer_Projet($filtre):array{
        $PDO=ouvrir_connexion_bd();
        $sql=" SELECT * FROM projet WHERE etatp=1 and nomp LIKE '%".$filtre."%' ";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array($filtre));
        $tab = $sth->fetchALL();
        fermer_connexion_bd($PDO);
        return $tab;
      }

       function paginnation(array $list,int $page,int $nombre_element_page){
        $totalElement=count($list);
        $nombre_page=get_nombre_page($list,$nombre_element_page);
        $start = ($page-1)*$nombre_element_page;
        $stop = ($totalElement-$nombre_page)+$nombre_element_page;
        $arraypage=array();
        for ($i=$start; $i < ($start + $nombre_element_page) ; $i++) {
                    if($i>=$totalElement){
                      return $arraypage;
                    }else{
                      array_push($arraypage,$list[$i]);
                    }
             }
             return $arraypage;
   }

    function get_nombre_page(array $list,int $nombre_element_page){
            $totalElement=count($list);
            $nombre_page=ceil($totalElement/$nombre_element_page);
            return $nombre_page;
    }
