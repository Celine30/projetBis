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
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['prenom'] = $data['prenom'];
        $_SESSION['question'] = $data['question'];
        $_SESSION['reponse'] = $data['reponse'];
        $_SESSION['password'] = $data['password'];


        echo $this->twig->render('connected.twig', array(
            'session' => $_SESSION ,
            'partner'=> $partner,
        ));
    }

     public function connected_partner(){
        $this->connectedPartner();
    }

    public function logout(){

        $_SESSION['username'] = "";
        $_SESSION['nom'] = "";
        $_SESSION['prenom'] = "";
        session_destroy();

        header('location:index.php?action=user!connexion');
    }

    public function partner($partner, $message="" )
    {

        if(isset($_SESSION['prenom'])) {

            //$partnerB = $partner->Get_All();
            $BackManager = new model\BackManager();
            $partnerB = $BackManager->partner($partner);

            $com_partner = new Model\BackManager();
            $comments = $com_partner->list_com($partner);

            $up_partner = new Model\BackManager();
            $comments_up = $up_partner->list_up($partner);

            $down_partner = new Model\BackManager();
            $comments_down = $down_partner->list_down($partner);

            $opinionGiven= new Model\BackManager();
            $opinionGiven = $opinionGiven->req_avis($partner,$_SESSION['id_user']);

          echo $this->twig->render('partner.twig', array(
              'partner' => $partnerB,
              'comments' => $comments,
              'comments_up' => $comments_up,
              'comments_down' => $comments_down,
              'message'=>$message,
              'opinion'=>$opinionGiven

            ));

        }else{
            $this->logout();
        }

    }
    public function view_add_com($partner)
    {
        if(isset($_SESSION['prenom'])) {

        $BackManager = new model\BackManager();
        $partner = $BackManager->partner($partner);

        echo $this->twig->render('partner.twig', array(
            'partner' => $partner,
            'comment' => 'comment',
        ));
          }else{
            $this->logout();
        }
    }

    public function User_avis($partner, $auteur, $avis){

        $add_avis = new Model\BackManager();
        $message = $add_avis->add_avis($partner, $auteur,$avis );

        $this->partner($partner,$message);

    }

    public function profile_show()
    {
         if(isset($_SESSION['prenom'])) {

        echo $this->twig->render('profile.twig', array(
            'session' => $_SESSION,
            'password' => "XXXXXXXXX",
             ));
        }else {
            $this->logout();
        }
    }

}