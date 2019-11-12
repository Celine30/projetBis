<?php


namespace Project\Model;

use Project\Model;

class BackManager extends Manager
{
    public function userQuestion($username)
    {
        $bdd = $this->dbConnect();
        $reqQuestion = $bdd->QUERY('SELECT question FROM userbank WHERE username="' . $username . '"');
        $data = $reqQuestion->fetch();

        $question = $data['question'];
        return $question;
    }

    public function userAnswer($username)
    {
        $bdd = $this->dbConnect();
        $reqAnswer = $bdd->QUERY('SELECT reponse FROM userbank WHERE username="' . $username . '"');
        $data = $reqAnswer->fetch();

        $answer = $data['reponse'];
        return $answer;
    }

    public function resetPassword($username, $password)
    {
        $bdd = $this->dbConnect();
        $bdd->exec('UPDATE userbank SET password = "' . $password . '" WHERE username = "' . $username . '"');
    }

    public function checkPassword($username)
    {
        $bdd = $this->dbConnect();
        $reqMdp = $bdd->QUERY('SELECT password FROM userbank WHERE username="' . $username . '"');
        $data = $reqMdp->fetch();

        $Mdp = $data['password'];
        return $Mdp;
    }

    public function createCookies($username, $password)
    {
        setcookie('username');
        unset($_COOKIE['username']);
        setcookie('password');
        unset($_COOKIE['password']);

        setcookie('username', $username, time() + 365 * 24 * 3600, null, null, false, true);
        setcookie('password', $password, time() + 365 * 24 * 3600, null, null, false, true);
    }


    public function partner_list()
    {
        $bdd = $this->dbConnect();
        $reqActor = $bdd->QUERY('SELECT * FROM acteur');

            while ($data = $reqActor->fetch()) {
                $partner[] = $data;
            }

        return $partner;
    }

    public function partner($partner)
    {
        $bdd = $this->dbConnect();
        $reqActor = $bdd->QUERY('SELECT * FROM acteur WHERE id_acteur="'. $partner . '"');

        $partner = $reqActor->fetch();
        return $partner;
    }


     public function add_com($partner, $comment, $auteur)
     {
         $bdd = $this->dbConnect();
         $req = $bdd->prepare('INSERT INTO PartnerGBAF (id_user, id_acteur, date_creation, post) VALUES (:id_user, :id_acteur, NOW(), :post)');
         $req->execute(array(
             'id_user' => $auteur,
             'id_acteur' => $partner,
             'post'=> $comment
         ));
         $comment='valide';
         return $comment;
     }

     public function list_com($partner)
     {
         $bdd = $this->dbConnect();

         $req_list = $bdd->QUERY('SELECT u.prenom AS prenom, DATE_FORMAT(p.date_creation, \'%d/%m/%Y à %Hh%i\') AS date_creation , p.post AS post FROM userbank u INNER JOIN PartnerGBAF p ON u.id_user = p.id_user WHERE p.id_acteur="' . $partner . '" ORDER BY date_creation DESC');

         $comments=[];

         while ($data = $req_list->fetch()) {
             $comments[] = $data;
         }
         return $comments;
     }


     public function list_up($partner)
     {
         $bdd = $this->dbConnect();

         $comments_up=[];

         $req_up = $bdd->QUERY('SELECT vote FROM vote WHERE vote="good" and id_acteur="' . $partner . '"');

         while ($data = $req_up->fetch()) {
             $comments_up[] = $data;
         }

         return $comments_up;
     }

     public function list_down($partner)
     {
         $bdd = $this->dbConnect();

         $req_down = $bdd->QUERY('SELECT vote FROM vote WHERE vote="bad" and id_acteur="' . $partner . '"');

         $comments_down=[];

         while ($data = $req_down->fetch()) {
             $comments_down[] = $data;
         }

         return $comments_down;
     }

     public function add_avis($partner,$auteur ,$avis)
     {
         $bdd = $this->dbConnect();
         $reqAvis = $bdd->QUERY('SELECT vote FROM vote WHERE id_user="' . $auteur . '"and id_acteur= "' . $partner . '"');

         if($data = $reqAvis->fetch()){

             $bdd->exec('UPDATE vote SET vote = "'.$avis.'" WHERE id_user="' . $auteur . '"and id_acteur= "' . $partner . '"');

            // $message = 'vous avez déjà donné votre avis';
            // return $message;

         }else{
             $req = $bdd->prepare('INSERT INTO vote (id_user, id_acteur, vote) VALUES (:id_user, :id_acteur, :vote)');
             $req->execute(array(
                 'id_user' => $auteur,
                 'id_acteur' => $partner,
                 'vote' => $avis
             ));
         }
     }

     public function req_avis($partner,$auteur)
     {
         $bdd = $this->dbConnect();
         $reqAvis = $bdd->QUERY('SELECT vote FROM vote WHERE id_user="' . $auteur . '"and id_acteur= "' . $partner . '"');

        $data = $reqAvis->fetch();
        $opinionGiven = $data['vote'];
        return $opinionGiven;

     }

}