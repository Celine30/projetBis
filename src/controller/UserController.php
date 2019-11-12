<?php

namespace Project\Controller;

use Twig\Environment;
//use Tracy\Debugger;
//Debugger::enable();
use Project\Model;

class UserController extends Controller
{

    public function connexion()
    {
       $_SESSION['username'] = "";
        $_SESSION['nom'] = "";
        $_SESSION['prenom'] = "";
       session_destroy();

        if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
            return $this->twig->render('connexion.twig', ['register' => [
                'username' => $_COOKIE['username'],
                'password' => $_COOKIE['password']
            ]]);
        } else {
            return $this->twig->render('connexion.twig');
        }
    }

    public function inscription()
    {
        return $this->twig->render('inscription.twig');
    }

    public function contact()
    {
        return $this->twig->render('contact.twig');
    }

    public function mentions()
    {
        return $this->twig->render('mentions_legales.twig');
    }

    public function error()
    {
        echo 'oups';
    }

    public function control_double()
    {
        if (count(array_filter($_POST)) === count($_POST)) {

            $UserManager = new model\UserManager();
            $inscription = $UserManager->userControl(htmlspecialchars($_POST['last_name']), htmlspecialchars($_POST['first_name']), htmlspecialchars($_POST['username']), htmlspecialchars($_POST['user_password']), htmlspecialchars($_POST['question']), htmlspecialchars($_POST['answer']));

            if ($inscription == 'valid') {

               $_SESSION['username'] = htmlspecialchars($_POST['username']);

                $this->connectedPartner();

            }else{

                $message = '';

                if ($inscription == 'nom'){
                    $message = 'Le nom et le prénom indiqués existe déja';
                }elseif($inscription == 'username'){
                    $message = 'L\'username indiqué existe déja';
                }elseif($inscription == 'usernamenom'){
                    $message = 'L\'username, le nom et le prénom indiqués existe déja';
                }

                return $this->twig->render('inscription.twig', array(
                'message' => $message));

            }

        } else {

            return $this->twig->render('inscription.twig');
        }
    }

    public function connected()
    {
        if (count(array_filter($_POST)) === count($_POST)) {
            $UserManager = new model\UserManager();

        } else {
            echo 'merci de tout remplir';
            return $this->twig->render('connexion.twig');
        }
    }

    public function mdp_forget()
    {
        return $this->twig->render('mdpForget.twig');
    }


    public function home_show()
    {
        if(isset($_SESSION['prenom'])) {
            $this->connectedPartner();
        }else {
            $this->logout();
        }
    }

    public function change_profile()
    {
        if(isset($_SESSION['prenom'])) {
        return $this->twig->render('profile.twig', array(
            'change' => 'change'));
         }else {
            $this->logout();
        }
    }

}


