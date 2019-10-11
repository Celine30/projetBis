<?php



namespace Project\controller;
use Twig\Environment;
use Project\model;
session_start();
class BackController
{
    protected $twig = null;

    public function __construct(Environment $twig){
        $this->twig = $twig;
    }

    function watch_question(){
        if (isset($_POST['username'])) {
            $BackManager = new model\BackManager();
            $BackManager->userQuestion($_POST['username']);
            if (isset($_SESSION['question']) && isset($_SESSION['reponse'])) {
                echo $this->twig->render('mdpForget.twig', ['user' => [
                    'username' => $_POST['username'],
                    'question' => $_SESSION['question'],
                    'reponse' => $_SESSION['reponse']
                ]]);

            } else {
                echo 'merci de remplir votre Username';
            }
        }
    }

    function control_question(){

          if($_POST['answer']== $_SESSION['reponse']){
              echo 'ok';
          }else{
              echo ' pas ok';
          }
    }



}