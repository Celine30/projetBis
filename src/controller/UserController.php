<?php

namespace Project\Controller;

use Twig\Environment;
use Tracy\Debugger;
Debugger::enable();
use Project\Model;

class UserController extends Controller
{

    public function connexion()
    {
        $_SESSION['username'] = "";
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

    public function logout()
    {

        $_SESSION['username'] = "";
        session_destroy();
        echo 'Vous êtes deconnecté';
        header('location:index.php?action=user!connexion');
    }

    public function inscription()
    {
        return $this->twig->render('inscription.twig');
    }

    public function error()
    {
        echo 'oups';
    }

    public function control_double()
    {
        if (count(array_filter($_POST)) === count($_POST)) {

            $UserManager = new model\UserManager();
            $inscription = $UserManager->userControl($_POST['last_name'], $_POST['first_name'], $_POST['username'], $_POST['user_password'], $_POST['question'], $_POST['answer']);

            if ($inscription == 'valide') {

                $_SESSION['username'] = $_POST['username'];

                return $this->twig->render('connected.twig', array(
                    'session' => $_SESSION));
            }
        } else {
            echo 'merci de tout remplir';
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


    public function profile_show()
    {
        $UserManager = new model\UserManager();
        $data = $UserManager->user_profile($_SESSION['username']);

        $_SESSION['question'] = $data['question'];
        $_SESSION['reponse'] = $data['reponse'];
        $_SESSION['password'] = $data['password'];

        return $this->twig->render('profile.twig', array(
            'first_name' => $data['nom'],
            'last_name' => $data['prenom'],
            'question' => $data['question'],
            'answer' => $data['reponse'],
            'password' => "XXXXXXXXX",

        ));
    }

    public function home_show()
    {
        $this->connectedPartner();
    }

    public function change_profile()
    {
        return $this->twig->render('profile.twig', array(
            'change' => 'change'));

    }

}

