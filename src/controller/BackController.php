<?php

namespace Project\controller;

use Twig\Environment;
use Project\model;



class BackController
{
    protected $twig = null;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function watch_question()
    {
        if (isset($_POST['username'])) {
            $_SESSION = [];

            $_SESSION['username'] = $_POST['username'];

            $BackManager = new model\BackManager();
            $question = $BackManager->userQuestion($_POST['username']);

            if (isset($question)) {

                $_SESSION['question'] = $question;

                return $this->twig->render('mdpForget.twig', array(
                    'session' => $_SESSION
                ));
            } else {
                echo 'merci de remplir votre Username';
            }
        }
    }

    public function control_question()
    {
        $BackManager = new model\BackManager();
        $answer = $BackManager->userReponse($_SESSION['username']);

        if (isset($answer)) {
            if ($_POST['answer'] == $answer) {

                return $this->twig->render('mdpForget.twig', array(
                    'session' => $_SESSION,
                    'answer' => 'ok'
                ));
            } else {
                return $this->twig->render('mdpForget.twig', array(
                    'session' => $_SESSION,
                    'answer' => 'false'
                ));
            }
        }
    }

    public function reset_mdp(){
        $BackManager = new model\BackManager();
        $BackManager->resetPassword($_SESSION['username'],$_POST['user_password']);

    }




}