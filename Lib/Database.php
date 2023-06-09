<?php
function ouvrir_connexion_bd(): PDO
{
    try {
        $option = [];
        $PDO = new PDO(CHAINE_DE_CONNEXION, USER_DB, PASSWORD_DB);
        //$PDO = new PDO(CHAINE_DE_CONNEXION, USER_DB, PASSWORD_DB);
        return $PDO;
    } catch (PDOException $e) {
        die($e->getmessage());
    }
}
function fermer_connexion_bd(PDO $PDO)
{
    $PDO = NULL;
}
