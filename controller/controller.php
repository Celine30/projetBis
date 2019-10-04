<?php

require '../../vendor/autoload.php';
require_once('model/UserManager.php');


function twig()
{
    $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../view');
    $twig = new \Twig\Environment($loader, [
        'cache' => false,
    ]);
   return $twig;
}


function connexion(){
     $twig=twig();
echo $twig->render('connexion.twig' );
}

function inscription(){
    $twig=twig();
    echo $twig->render('inscription.twig' );
}


function usercreat($last_name, $first_name, $username, $user_password, $question, $answer ){
     $twig=twig();

    $UserManager=new UserManager();

    $creat=$UserManager->userInsert($last_name, $first_name, $username, $user_password,$question, $answer );

  echo $twig->render('connected.twig' );

}