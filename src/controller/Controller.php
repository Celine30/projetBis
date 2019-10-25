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



    public function partner($idName,$partner )
    {

        $partner = $partner->Get_All();

        $com_partner = new Model\BackManager();
        $comments = $com_partner->list_com($idName);

        $up_partner = new Model\BackManager();
        $comments_up = $up_partner->list_up($idName);

        $down_partner = new Model\BackManager();
        $comments_down = $down_partner->list_down($idName);

        echo $this->twig->render('partner.twig', array(
            'partner' => $partner,
            'comments' => $comments,
            'comments_up' => $comments_up,
            'comments_down' => $comments_down


        ));

    }
    public function view_add_com($partner )
    {
        $partner = $partner->Get_All();
        echo $this->twig->render('partner.twig', array(
            'partner' => $partner,
            'comment' => 'comment'
        ));
    }
}