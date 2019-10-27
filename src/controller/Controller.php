<?php


namespace Project\Controller;
use http\Message;
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

    public function partner($idName,$partner, $message="" )
    {

        if(isset($_SESSION['prenom'])) {

            $partnerB = $partner->Get_All();

            $com_partner = new Model\BackManager();
            $comments = $com_partner->list_com($idName);

            $up_partner = new Model\BackManager();
            $comments_up = $up_partner->list_up($idName);

            $down_partner = new Model\BackManager();
            $comments_down = $down_partner->list_down($idName);

            echo $this->twig->render('partner.twig', array(
                'partner' => $partnerB,
                'comments' => $comments,
                'comments_up' => $comments_up,
                'comments_down' => $comments_down,
                'message'=>$message

            ));
        }else{
            $this->logout();
        }

    }
    public function view_add_com($partner )
    {
        if(isset($_SESSION['prenom'])) {
        $partner = $partner->Get_All();
        echo $this->twig->render('partner.twig', array(
            'partner' => $partner,
            'comment' => 'comment',
            'connexion'=> 'login'
        ));
          }else{
            $this->logout();
        }
    }

    public function User_avis($idName, $username, $avis){

        $add_avis = new Model\BackManager();
        $message = $add_avis->add_avis($idName, $username,$avis );

        $this->$idName($message);

    }

    public function profile_show()
    {
         if(isset($_SESSION['prenom'])) {
        $UserManager = new model\UserManager();
        $data = $UserManager->user_profile($_SESSION['username']);

        $_SESSION['question'] = $data['question'];
        $_SESSION['reponse'] = $data['reponse'];
        $_SESSION['password'] = $data['password'];

        echo $this->twig->render('profile.twig', array(
            'first_name' => $data['nom'],
            'last_name' => $data['prenom'],
            'question' => $data['question'],
            'answer' => $data['reponse'],
            'password' => "XXXXXXXXX",
             ));
        }else {
            $this->logout();
        }
    }

}