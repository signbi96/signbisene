<?php
      function insert_Categorie(array $data):int{
       
        $PDO=ouvrir_connexion_bd();
          $sql="INSERT INTO categorie ( libellec,idp,etatc)
          VALUES (?,?,?)";
          $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          $sth->execute($data);
          $nbre_ligne_insert = $sth->rowCount();
          fermer_connexion_bd($PDO);
          return $nbre_ligne_insert;
       }
       function find_all_Categorie_ById($idp):array{
        $PDO=ouvrir_connexion_bd();
          $sql="select * from categorie c,projet p 
          where c.idp = p.idp 
          and c.idp = ?
          and c.etatc = 1 order by(c.idc) desc ";
          $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          $sth->execute(array($idp));
          $data = $sth->fetchALL();
          fermer_connexion_bd($PDO);
          return $data;
        }
        function find_all_Categorie():array{
            $PDO=ouvrir_connexion_bd();
            $sql="select * from categorie where etatc = 1 ";
            $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();
            $data = $sth->fetchALL();
            fermer_connexion_bd($PDO);
            return $data;
         }

    
      function update_Categorie($idc,$libellec):int{   
        $PDO=ouvrir_connexion_bd();
        $sql="UPDATE `categorie` SET libellec =? where idc =? ";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array($libellec,$idc));
        $nbre_ligne_insert = $sth->rowCount();
        fermer_connexion_bd($PDO);
        return $nbre_ligne_insert;

     };
      function archive_Categorie($idc,$etatc):array{
        $PDO=ouvrir_connexion_bd();
        $sql="UPDATE `categorie` SET etatc =? where idc =? ";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array($etatc,$idc));
        $tab = $sth->fetchALL();
        fermer_connexion_bd($PDO);
        return $tab;
      }

      
      function filtrer_Categorie($filtre):array{
        $PDO=ouvrir_connexion_bd();
        $sql=" SELECT * FROM categorie WHERE etatc=1 and libellec LIKE '%".$filtre."%' ";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array($filtre));
        $tab = $sth->fetchALL();
        fermer_connexion_bd($PDO);
        return $tab;
      }

