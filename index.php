<?php

require('controller/controller.php');


if(isset($_GET['action'])) {

    if ($_GET['action'] === 'connexion') {

        connexion();

    } elseif ($_GET['action'] === 'post-inscription') {

        if (isset($_POST['last_name']) && isset($_POST['first_name']) && isset($_POST['username']) && isset($_POST['user_password'])&& isset($_POST['question'])&& isset($_POST['answer'])) {
            usercreat($_POST['last_name'], $_POST['first_name'], $_POST['username'], $_POST['user_password'], $_POST['question'], $_POST['answer']);
         } else {
            echo 'Problème de connextion, merci de retenter ';
        }
    } elseif ($_GET['action'] === 'inscription'){
        inscription();
    }




    }else{

    inscription();

}

