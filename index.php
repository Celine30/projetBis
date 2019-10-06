<?php

require('controller/controller.php');


if(isset($_GET['action'])) {

    if ($_GET['action'] === 'connexion') {

        connexion();

    } elseif ($_GET['action'] === 'post-inscription') {

        if(count(array_filter($_POST))===count($_POST)) {
        usercreat($_POST['last_name'], $_POST['first_name'], $_POST['username'], $_POST['user_password'], $_POST['question'], $_POST['answer']);
         } else {
         echo 'Problème de connexion, merci de retenter ';
        }
    } elseif ($_GET['action'] === 'inscription'){
        inscription();
    }




    }else{
    inscription();

}



