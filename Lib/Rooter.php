<?php
if (isset($_REQUEST['Controller'])) {
    if ($_REQUEST['Controller'] == 'User') {
        require_once(ROUTE_DIR . 'Controller/User.Controller.php');
    } elseif ($_REQUEST['Controller'] == "Projet") {
        require_once(ROUTE_DIR . "Controller/Projet.Controller.php");
    } elseif ($_REQUEST['Controller'] == "Security") {
        require_once(ROUTE_DIR . "Controller/Security.Controller.php");
    }elseif ($_REQUEST['Controller'] == "Categorie") {
        require_once(ROUTE_DIR . "Controller/Categorie.Controller.php");
    }elseif ($_REQUEST['Controller'] == "Tache") {
        require_once(ROUTE_DIR . "Controller/Tache.Controller.php");
    }elseif ($_REQUEST['Controller'] == "Equipe") {
        require_once(ROUTE_DIR . "Controller/Equipe.Controller.php");
    }elseif ($_REQUEST['Controller'] == "Affectation") {
        require_once(ROUTE_DIR . "Controller/Affectation.Controller.php");
    }
}
