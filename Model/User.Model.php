<?php
      function insert_User(array $data):int{
        
        $PDO=ouvrir_connexion_bd();
          $sql="INSERT INTO user (nomU,prenomU,mailU,passwordU,idR,messagerie,deja_inviter)
          VALUES (?,?,?,?,?,?,?)";
          $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          $sth->execute($data);
          $nbre_ligne_insert = $sth->rowCount();
          fermer_connexion_bd($PDO);
          return $nbre_ligne_insert;
       }
    function find_user_by_loguin_password($mailU,$passwordU){
        $PDO=ouvrir_connexion_bd();
        $sql="select * from user u,role r where u.idR=r.idR and u.mailU = ? and u.passwordU = ?";
        $sth=$PDO->prepare($sql,array(PDO::ATTR_CURSOR=> PDO::CURSOR_FWDONLY));
        $sth->execute(array($mailU, $passwordU));
        $data=$sth->fetch(PDO::FETCH_ASSOC);
        fermer_connexion_bd($PDO);
        return  $data;
      }
      function find_all_user():array{
        $PDO=ouvrir_connexion_bd();
         $sql="select * from user where deja_inviter = 0";
         $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
         $sth->execute();
         $data = $sth->fetchALL();
         fermer_connexion_bd($PDO);
         return $data;
      }

      function find_user_by_id($idU):array{
        $PDO=ouvrir_connexion_bd();
         $sql="select * from user where idU = ?";
         $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
         $sth->execute(array($idU));
         $data = $sth->fetchALL();
         fermer_connexion_bd($PDO);
         return $data;
      }
      function Alerte_user($idU,$messagerie,$deja_inviter):array{
        $PDO=ouvrir_connexion_bd();
        $sql="UPDATE `user` SET messagerie = ?, deja_inviter = ? where idU =? ";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array($messagerie,$deja_inviter,$idU));
        $tab = $sth->fetchALL();
        fermer_connexion_bd($PDO);
        return $tab;
      }
?>