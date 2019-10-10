<?php


namespace Project\controller;

use Twig\Environment;
use Tracy\Debugger;
Debugger::enable();

class UserController
{

    protected $twig = null;

    public function __construct(Environment $twig){
        $this->twig = $twig;
    }

    function connexion(){
        echo $this->twig->render('connexion.twig' );
    }

    function inscription(){
        echo $this->twig->render('inscription.twig' );
    }

    function error(){
        echo 'oups';
    }

}
/*use Project\model;


use Tracy\Debugger;
Debugger::enable();

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
    $UserManager = new \project\model\UserManager();
    $creat = $UserManager->userInsert($last_name, $first_name, $username, $user_password,$question, $answer );

    echo $twig->render('connected.twig' );

*/
