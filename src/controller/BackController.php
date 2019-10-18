<?php

namespace Project\Controller;

use Twig\Environment;
use Project\Model;



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

        $UserManager = new model\UserManager();
        $data= $UserManager->user_profile($_SESSION['username']);
        $_SESSION['nom'] = $data['nom'];
        $_SESSION['prenom'] = $data['prenom'];
        $_SESSION['password'] = $data['password'];

        return $this->twig->render('connected.twig', array(
                    'session' => $_SESSION
                ));

    }

    public function check_mdp(){
        $BackManager = new Model\BackManager();
        $Mdp = $BackManager->checkPassword($_POST['username']);

       if (isset($Mdp)) {
           if (password_verify($_POST['user_password'], $Mdp)) {

                 $UserManager = new model\UserManager();
                 $data= $UserManager->user_profile($_POST['username']);
                 $_SESSION['username'] = $_POST['username'];
                 $_SESSION['nom'] = $data['nom'];
                 $_SESSION['prenom'] = $data['prenom'];
                 $_SESSION['question'] = $data['question'];
                 $_SESSION['reponse'] = $data['reponse'];
                 $_SESSION['password'] = $data['password'];


               $_SESSION['username'] = $_POST['username'];

               if(isset($_POST['register'])) {
                   $BackManager->createCookies($_POST['username'],$_POST['user_password']);
                  return $this->twig->render('connected.twig', array(
                    'session' => $_SESSION ));

               }elseif(isset($_POST['wipe_register'])) {
                   $BackManager->wipeCookies();
                   return $this->twig->render('connexion.twig', array(
                    'session' => $_SESSION ));

               }else{
                    return $this->twig->render('connected.twig', array(
                    'session' => $_SESSION ));
               }

           }else{
               return $this->twig->render('connexion.twig',array(
                   'username'=> $_POST['username'],
                   'erreur'=>'<p class="alert alert-warning"> erreur d\'authentification </p>'
               ));
           }
      }else{
           echo ' ce username n\'existe pas';
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

   $_SESSION['username']=$_POST['username'];
    }
}