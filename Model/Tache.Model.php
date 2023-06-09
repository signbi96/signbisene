<?php
      function insert_Tache(array $data):int{
       
        $PDO=ouvrir_connexion_bd();
          $sql="INSERT INTO tache ( nomt,dated,datef,photot,idc,etatt,idp,deja_affecter,rappelle)
          VALUES (?,?,?,?,?,?,?,?,?)";
          $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          $sth->execute($data);
          $nbre_ligne_insert = $sth->rowCount();
          fermer_connexion_bd($PDO);
          return $nbre_ligne_insert;
       }
       function find_all_Tache_ById($idc):array{
        $PDO=ouvrir_connexion_bd();
          $sql="select * from tache where idc = ? and etatt = 1 ";
          $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          $sth->execute(array($idc));
          $data = $sth->fetchALL();
          fermer_connexion_bd($PDO);
          return $data;
        }
        function find_all_information_Tache_ById($idt):array{
          $PDO=ouvrir_connexion_bd();
            $sql="select * from tache where idt = ? and etatt = 1";
            $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array($idt));
            $data = $sth->fetchALL();
            fermer_connexion_bd($PDO);
            return $data;
          }
          function find_all_Tache_ByProjet($idp):array{
            $PDO=ouvrir_connexion_bd();
              $sql="select * from tache where idp = ? and etatt = 1 and deja_affecter = 0";
              $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
              $sth->execute(array($idp));
              $data = $sth->fetchALL();
              fermer_connexion_bd($PDO);
              return $data;
            }
        function find_all_Tache():array{
            $PDO=ouvrir_connexion_bd();
            $sql="select * from tache where etatt = 1 ";
            $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();
            $data = $sth->fetchALL();
            fermer_connexion_bd($PDO);
            return $data;
         }
      function update_Tache($idt,$nomt,$dated,$datef,$photot):int{ 
        $PDO=ouvrir_connexion_bd();
        $sql="UPDATE `tache` SET nomt =?,dated=?,datef=?,photot=? where idt =? ";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array($nomt,$dated,$datef,$photot,$idt));
        $nbre_ligne_insert = $sth->rowCount();
        fermer_connexion_bd($PDO);
        return $nbre_ligne_insert;

       };
      function archive_Tache($idt,$etatt):array{
        $PDO=ouvrir_connexion_bd();
        $sql="UPDATE `tache` SET etatt =? where idt =? ";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array($etatt,$idt));
        $tab = $sth->fetchALL();
        fermer_connexion_bd($PDO);
        return $tab;
      }

      
      function alerte_Tache($idt,$deja_affecter):array{
        $PDO=ouvrir_connexion_bd();
        $sql="UPDATE `tache` SET deja_affecter =? where idt =? ";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array($deja_affecter,$idt));
        $tab = $sth->fetchALL();
        fermer_connexion_bd($PDO);
        return $tab;
      }


