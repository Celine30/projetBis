<?php

namespace Project\Controller;

use Twig\Environment;
use Tracy\Debugger;
Debugger::enable();
use Project\Model;

class UserController
{

    protected $twig = null;

    public function __construct(Environment $twig){
        $this->twig = $twig;
    }

    function connexion(){
        return $this->twig->render('connexion.twig', ['register'=>[
            'username'=> $_COOKIE['username'],
            'password'=> $_COOKIE['password']
        ]]);
    }

    function inscription(){
        return $this->twig->render('inscription.twig' );
    }

    function error(){
        echo 'oups';
    }

    function control_double(){
        if(count(array_filter($_POST))===count($_POST)) {

            $UserManager = new model\UserManager();
            $inscription = $UserManager->userControl($_POST['last_name'], $_POST['first_name'], $_POST['username'], $_POST['user_password'], $_POST['question'], $_POST['answer']);

            if($inscription=='valide'){
                return $this->twig->render('connected.twig' );
            }
        }else{
            echo 'merci de tout remplir';
            return $this->twig->render('inscription.twig' );
        }
    }

    function connected(){
        if(count(array_filter($_POST))===count($_POST)) {
           $UserManager = new model\UserManager();

        }else{
            echo 'merci de tout remplir';
            return $this->twig->render('connexion.twig' );
        }
    }

    function mdp_forget(){
        return $this->twig->render('mdpForget.twig' );
    }
}

