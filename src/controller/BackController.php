<?php

namespace Project\Controller;

use Twig\Environment;
use Project\Model;



class BackController extends PartnerController
{

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
        $answer = $BackManager->userAnswer($_SESSION['username']);

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

        $password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

        $BackManager = new model\BackManager();
        $BackManager->resetPassword($_SESSION['username'],$password);

        $this->connectedPartner();

    }

    public function check_mdp(){

        if (isset ($_POST['username'])) {
        $BackManager = new Model\BackManager();
        $Mdp = $BackManager->checkPassword($_POST['username']);

       if (isset($Mdp)) {
           if (password_verify($_POST['user_password'], $Mdp)) {

               $_SESSION['username'] = $_POST['username'];

               if(isset($_POST['register'])) {
                   $BackManager->createCookies($_SESSION['username'],$_POST['user_password']);
                   $this->connectedPartner();

               }elseif(isset($_POST['wipe_register'])) {
                   $BackManager->wipeCookies();
                   return $this->twig->render('connexion.twig');

               }else{
                    $this->connectedPartner();
               }

           }else{
               return $this->twig->render('connexion.twig',array(
                   'username'=> $_POST['username'],
                   'erreur'=>'<p> erreur d\'authentification </p>'
               ));
           }
      }else{
           echo ' ce username n\'existe pas';
       }
    }else{

        $this->logout();

        }
    }

    public function change_profile()
    {
        if(isset($_POST['username'])&& ($_POST['username']!= "")){
            $ChangeManager = new Model\ChangeManager();
            $ChangeManager->change_username($_POST['username'],$_SESSION['username']);
            $_SESSION['username']=$_POST['username'];
        }
        if(isset($_POST['first_name'])&& ($_POST['first_name']!= "")){
            $ChangeManager = new Model\ChangeManager();
            $ChangeManager->change_nom($_POST['first_name'],$_SESSION['username']);
            $_SESSION['nom']=$_POST['first_name'];
        }
        if(isset($_POST['last_name'])&& ($_POST['last_name']!= "")){
            $ChangeManager = new Model\ChangeManager();
            $ChangeManager->change_prenom($_POST['last_name'],$_SESSION['username']);
            $_SESSION['nom']=$_POST['first_name'];
        }
        if(isset($_POST['user_password'])&& ($_POST['user_password']!= "")){
            echo 'password =>' . $_POST['user_password'];
        }
    }

    public function add_com()
    {
         if(isset($_POST['comment']) && ($_POST['comment']!= "") && isset($_POST['icone']) && isset($_POST['idName'])){

             $addComment = new Model\BackManager();
             $addComment->add_com($_POST['idName'], $_POST['comment'], $_SESSION['username'], $_POST['icone']);

             $class = $_POST['idName'];

             $this->$class();

         }else{
             echo'merci de remplir tous les champs';
         }

    }


}