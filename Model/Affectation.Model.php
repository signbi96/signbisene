<?php
      function insert_Affectation(array $data):int{
       
        $PDO=ouvrir_connexion_bd();
          $sql="INSERT INTO affectation (idue,idt,nomt,dated,datef,etataf) VALUES (?,?,?,?,?,?)";
          $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          $sth->execute($data);
          $nbre_ligne_insert = $sth->rowCount();
          fermer_connexion_bd($PDO);
          return $nbre_ligne_insert;
       }
       function find_all_Affectation_ById($idue):array{
        $PDO=ouvrir_connexion_bd();
          $sql="select * from affectation where etataf = 1 and idue = ?";
          $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          $sth->execute(array($idue));
          $data = $sth->fetchALL();
          fermer_connexion_bd($PDO);
          return $data;
        }
        function find_all_Affectation():array{
            $PDO=ouvrir_connexion_bd();
            $sql="select * from affectation where etataf = 1 ";
            $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();
            $data = $sth->fetchALL();
            fermer_connexion_bd($PDO);
            return $data;
         }

    
      
      function archive_Affectation($idaf,$etataf):array{
        $PDO=ouvrir_connexion_bd();
        $sql="UPDATE `affectation` SET etataf =? where idaf =? ";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array($etataf,$idaf));
        $tab = $sth->fetchALL();
        fermer_connexion_bd($PDO);
        return $tab;
      }


    

