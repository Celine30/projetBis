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

            $BackManager = new model\BackManager();
            $question = $BackManager->userQuestion(htmlspecialchars($_POST['username']));

            if (isset($question)) {

                $_SESSION['username'] = htmlspecialchars($_POST['username']);
                $_SESSION['question'] = $question;

                return $this->twig->render('mdpForget.twig', array(
                    'session' => $_SESSION
                ));
            } else {
                 return $this->twig->render('mdpForget.twig',array(
                     'message1' => 'Ce userName n\'existe pas'
                 ));
            }
        }
    }

    public function control_question()
    {
        $BackManager = new model\BackManager();
        $answer = $BackManager->userAnswer($_SESSION['username']);

        if (isset($answer)) {
            if (htmlspecialchars($_POST['answer']) == $answer) {

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

       $password = password_hash(htmlspecialchars($_POST['user_password']), PASSWORD_DEFAULT);

       $BackManager = new model\BackManager();
       $BackManager->resetPassword($_SESSION['username'],$password);

       $this->connectedPartner();

    }

    public function check_mdp(){

        if (isset ($_POST['username'])) {
        $BackManager = new Model\BackManager();
        $Mdp = $BackManager->checkPassword(htmlspecialchars($_POST['username']));

       if (isset($Mdp)) {

           if (password_verify($_POST['user_password'], $Mdp)) {

               $_SESSION['username'] = htmlspecialchars($_POST['username']);

               if(isset($_POST['register'])) {
                   $BackManager->createCookies($_SESSION['username'],htmlspecialchars($_POST['user_password']));
                   $this->connectedPartner();

               }else{
                    $this->connectedPartner();
               }

           }else{
               return $this->twig->render('connexion.twig',array(
                   'username'=> htmlspecialchars($_POST['username']),
                   'message2'=>'erreur d\'authentification'
               ));
           }
      }else{
           return $this->twig->render('connexion.twig', ['register' => [
               'username.' => $_COOKIE['username'],
               'password' => $_COOKIE['password'],
               'message' => 'Cet userName n\'existe pas'
               ]]);
       }
    }else{

        $this->logout();

        }
    }

    public function change_profile()
    {
      if(isset($_POST['username'])&& ($_POST['username']!= "")){
          $ChangeManager = new Model\ChangeManager();
          $ChangeManager->change_username(htmlspecialchars($_POST['username']),$_SESSION['username']);
          $_SESSION['username'] = htmlspecialchars($_POST['username']);
       }
        if(isset($_POST['first_name'])&& ($_POST['first_name']!= "")){
            $ChangeManager = new Model\ChangeManager();
            $ChangeManager->change_nom(htmlspecialchars($_POST['first_name']),$_SESSION['username']);
            $_SESSION['nom']=htmlspecialchars($_POST['first_name']);
        }
        if(isset($_POST['last_name'])&& ($_POST['last_name']!= "")){
            $ChangeManager = new Model\ChangeManager();
            $ChangeManager->change_prenom(htmlspecialchars($_POST['last_name']),$_SESSION['username']);
            $_SESSION['prenom']=htmlspecialchars($_POST['last_name']);
        }
        if(isset($_POST['user_password'])&& ($_POST['user_password']!= "")){
            $user_password_hash = password_hash(htmlspecialchars($_POST['user_password']), PASSWORD_DEFAULT);
            $ChangeManager = new Model\ChangeManager();
            $ChangeManager->change_password($user_password_hash,$_SESSION['username']);
        }

        $this-> profile_show();
    }

    public function add_com()
    {
         if(isset($_POST['comment']) && ($_POST['comment']!= "") && isset($_POST['id_acteur'])){

             $addComment = new Model\BackManager();
             $addComment->add_com(htmlspecialchars($_POST['id_acteur']), htmlspecialchars($_POST['comment']), $_SESSION['id_user']);

             header('location:index.php?partner='.htmlspecialchars($_POST['id_acteur']).'&action=partner!actor');

         }else{
             echo'merci de remplir tous les champs';
         }

    }

    public function contact()
    {

        $message='* message envoyé *';

     /*EN LOCAL

        $to      = 'celi.caurier@gmail.com';
        $subject = htmlspecialchars($_POST['demande']);
        $corpsMail = htmlspecialchars($_POST['contact']);
        $headers = array(
            'From' => 'contactGBAF.fr',
            'Reply-To' => htmlspecialchars($_POST['mail']),
            'X-Mailer' => 'PHP/' . phpversion()
        );

       mail($to, $subject, $corpsMail, $headers);

     */


    /*SUR LE SERVEUR
    */

        $name       = @trim(stripslashes($_POST['nom']));
        $fromBis    = @trim(stripslashes($_POST['mail']));
        $from       = 'contact@gbaf.fr';
        $subject    = @trim(stripslashes($_POST['demande']));
        $corps      = @trim(stripslashes($_POST['contact']));
        $to         = 'celi.caurier@gmail.com';


        $headers  = "";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
        $headers .= "From: ContactGBAF <{$from}>\r\n";
        $headers .= "Reply-To: <{$fromBis}>\r\n";
        $headers .= "Subject: {$subject}\r\n";
        $headers .= "X-Mailer: PHP/".phpversion()."\r\n";

        mail($to, $subject, $corps, $headers);





        return $this->twig->render('contact.twig', array(
            'message'=> $message
        ));

    }

}