<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //Redirection en cas de non connexion.
    session_start();
    
    require_once('./view/vue.php');
    require_once('./control/controleur.php');
    require_once('./model/Mouvement.php');
    require_once('./model/Brassin.php');
    require_once('./model/Biere.php');
    require_once('./model/BDD.php');

    $base = new BDD();

    /* PARTIE SPREADSHEET */

    // require('/root/vendor/autoload.php');

    //use PhpOffice\PhpSpreadsheet\Spreadsheet;
    //use PhpOffice\PhpSpreadsheet\Writer\Csv;
    if (!isset($_SESSION["connect"]))
    {
        (new controleur)->connection();
        exit();
    }

    if(isset($_GET["action"])) {
        switch($_GET["action"]) {
            case "connection":
                (new controleur)->connection();
                break;
            case "menu":
                (new controleur)->menu();
                break;
            case "ajoutBiere":
                (new controleur)->ajoutBiere();
                break;
            case "ajoutBrassin":
                (new controleur)->ajoutBrassin();
                break;
            case "ajoutMouvement":
                (new controleur)->ajoutMouvement();
                break;
            case "supprimer":
                (new controleur)->supprimer();
                break;
            case "modifBrassin":
                (new controleur)->modifBrassin();
                break;
            case "modifMouvement":
                (new controleur)->modifMouvement();
                break;
        }
    }
    else{
        (new controleur)->menu();
    }
?>