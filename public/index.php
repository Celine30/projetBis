<?php


use Project\controller\Router;

require '../vendor/autoload.php';


$router= new Router();
$router->display();





/*require '../src/controller/controller.php';


 switch ($_GET['action']) {
    case 'connexion':
        connexion();
        break;
    case 'post-inscription':
        if(count(array_filter($_POST))===count($_POST)) {
            usercreat($_POST['last_name'], $_POST['first_name'], $_POST['username'], $_POST['user_password'], $_POST['question'], $_POST['answer']);
        }else{ echo 'Problème de connexion, merci de retenter ';
        };
        break;
    case 'inscription':
        inscription();
        break;
    case 'mdp_forget':
        echo'ça fonctionne';
        break;
    default:
        inscription();

}

*/