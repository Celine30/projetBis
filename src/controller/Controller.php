<?php


namespace Project\Controller;
use Twig\Environment;
use Project\Model;

class Controller
{
  protected $twig = null;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function connectedPartner(){

        $BackManager = new model\BackManager();
        $partner = $BackManager->partner_list();

        $UserManager = new model\UserManager();
        $data= $UserManager->user_profile($_SESSION['username']);
        $_SESSION['nom'] = $data['nom'];
        $_SESSION['prenom'] = $data['prenom'];
        $_SESSION['question'] = $data['question'];
        $_SESSION['reponse'] = $data['reponse'];
        $_SESSION['password'] = $data['password'];

        echo $this->twig->render('connected.twig', array(
                      'session' => $_SESSION ,
                      'partner'=> $partner));
    }
}