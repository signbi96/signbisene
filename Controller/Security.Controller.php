<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['Views'])) {
        if ($_GET['Views'] == 'Inscription') {
            require(ROUTE_DIR . 'Views/Security/Inscription.html.php');
        } elseif ($_GET['Views'] == "Connexion") {
            require(ROUTE_DIR . 'Views/Security/Connexion.html.php');
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'Connexion') {
            Connecter_User($_POST['mailU'], $_POST['passwordU']);
        } elseif ($_POST['action'] == 'Inscription') {
            Inscrir_User($_POST);
        }
    }
}


function Inscrir_User(array $data): void
{
    $arrayError = array();
    extract($data);
    valide_champs($arrayError,'nomU',$nomU);
     valide_champs($arrayError,'prenomU',$prenomU);
     valide_libelle($arrayError,'mailU',$mailU);
    // valide_email_regex($arrayError,'mailU',$mailU);
     valide_libelle($arrayError,'passwordU',$passwordU); 
    if (form_valid($arrayError)) {
        if (est_admin()) {
            $data['libelleR'] = "Admin";
        } elseif (est_membre()) {
            $data['libelleR'] = "Membre";
        }
        $idR = 1;
        $messagerie = "";
        $deja_inviter = 0;
        $dati = [
            $nomU,
            $prenomU,
            $mailU,
            $passwordU,
            $idR,
            $messagerie,
            $deja_inviter
        ];
        $result = insert_User($dati);
        header('location:' . WEB_ROUTE . '?Controller=Security&Views=Connexion');
    } else {
        $_SESSION['arrayError'] = $arrayError;
        header('location:' . WEB_ROUTE . '?Controller=Security&Views=Inscription');
    }
}
function Connecter_User($mailu, $passwordu): void
{
    
    $arrayError = array();
    valide_libelle($arrayError, 'mailu', $mailu);
    valide_libelle($arrayError, 'passwordu', $passwordu);
    if (form_valid($arrayError)) {
        $data = find_user_by_loguin_password($mailu, $passwordu);
        if (count($data) == 0){
            $arrayError['invalid'] = "loguin ou password incorect";
            $_SESSION['arrayError'] = $arrayError;
            header('location:' . WEB_ROUTE . '?Controller=Security&Views=Connexion');
            exit();
        } else {
            $_SESSION['userConnect'] = $data;
            if ($data['libelleR'] == 'Membre') {
                header("location:" . WEB_ROUTE . '?Controller=Projet&Views=ListerProjet');
                exit();
            }
        }
    } else {
        $_SESSION['arrayError'] = $arrayError;
        header('location:' . WEB_ROUTE . '?Controller=Security&Views=Connexion');
        exit();
    }
}
