<?php
      function insert_Equipe(array $data):int{
        $PDO=ouvrir_connexion_bd();
          $sql="INSERT INTO equipe(nome,idp,etate)
          VALUES (?,?,?)";
          $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          $sth->execute($data);
          $LAST_ID = $PDO->lastInsertId();
         // $lastID = $sth->lastInsertId();
          fermer_connexion_bd($PDO);
          return $LAST_ID;
       }

       function insert_Membre(array $data):int{
        $PDO=ouvrir_connexion_bd();
          $sql="INSERT INTO userequipe(idU,ide,nomU,prenomU,etatue)
          VALUES (?,?,?,?,?)";
          $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          $sth->execute($data);
          $nbre_ligne_insert = $sth->rowCount();
          fermer_connexion_bd($PDO);
          return $nbre_ligne_insert;
       }
       function find_all_Equipe():array{
        $PDO=ouvrir_connexion_bd();
          $sql="select * from equipe  where etate = 1 order by(ide) asc";
          $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          $sth->execute();
          $data = $sth->fetchALL();
          fermer_connexion_bd($PDO);
          return $data;
        }
        function find_all_EquipeUser($id):array{
            $PDO=ouvrir_connexion_bd();
              $sql="select * from userequipe ue,user u 
               where u.idU=ue.idU
               and etatue = 1 
               and ue.ide = ? order by(ide) asc";
              $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
              $sth->execute(array($id));
              $data = $sth->fetchALL();
              fermer_connexion_bd($PDO);
              return $data;
            }

      function update_Equipe($ide,$nome):int{   
        $PDO=ouvrir_connexion_bd();
        $sql="UPDATE `equipe` SET nome =? where ide =? ";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array($nome,$ide));
        $nbre_ligne_insert = $sth->rowCount();
        fermer_connexion_bd($PDO);
        return $nbre_ligne_insert;

     };

     function update_Membre($idue,$idU):int{   
      $PDO=ouvrir_connexion_bd();
      $sql="UPDATE `userequipe` SET idU =? where idue =? ";
      $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth->execute(array($idU,$idue));
      $nbre_ligne_insert = $sth->rowCount();
      fermer_connexion_bd($PDO);
      return $nbre_ligne_insert;

   };
      function archive_Equipe($ide,$etate):array{
        $PDO=ouvrir_connexion_bd();
        $sql="UPDATE `equipe` SET etate =? where ide =? ";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array($etate,$ide));
        $tab = $sth->fetchALL();
        fermer_connexion_bd($PDO);
        return $tab;
      }

      function archive_Membre($idue,$etatue):array{
        $PDO=ouvrir_connexion_bd();
        $sql="UPDATE `userequipe` SET etatue = ? where idue =? ";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array($etatue,$idue));
        $tab = $sth->fetchALL();
        fermer_connexion_bd($PDO);
        return $tab;
      }
      function find_all_rappelle_by_idmembre($idU):array{
        $PDO=ouvrir_connexion_bd();
          $sql="select * from affectation a,tache t where a.idt = t.idt
          and a.idue = ?";
          $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          $sth->execute(array($idU));
          $data = $sth->fetchALL();
          fermer_connexion_bd($PDO);
          return $data;
        }
