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

    public function wipeCookies()
    {
        setcookie('username');
        unset($_COOKIE['username']);

        setcookie('password');
        unset($_COOKIE['password']);

    }

    public function partner_list()
    {
        $cde=new PartnerCde();
        $cde=$cde->Get_All();

        $dsa=new PartnerDsa();
        $dsa=$dsa->Get_All();

        $co=new PartnerCo();
        $co=$co->Get_All();

        $pro=new PartnerPro();
        $pro=$pro->Get_All();

        $partner=[];
        array_push($partner, $cde,$dsa,$co,$pro);

        return $partner;
    }

     public function add_com($idName, $comment, $auteur, $prenom)
     {
         $bdd = $this->dbConnect();
         $req = $bdd->prepare('INSERT INTO PartnerGBAF (idName, comment, auteur, prenom, date_creation) VALUES (:idName, :comment, :auteur, :prenom, NOW())');
         $req->execute(array(
             'idName' => $idName,
             'comment' => $comment,
             'auteur' => $auteur,
             'prenom'=>$prenom
         ));
         $comment='valide';
         return $comment;
        }

        public function list_com($idName)
        {
            $bdd = $this->dbConnect();

            $req_list = $bdd->QUERY('SELECT comment, auteur, prenom, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%i\') AS date_creation, avis FROM PartnerGBAF WHERE idName="' . $idName . '" and comment!="" ORDER BY date_creation DESC');

            while ($data = $req_list->fetch()) {
                $comments[] = $data;
            }

            return $comments;

        }


        public function list_up($idName)
        {
            $bdd = $this->dbConnect();

            $req_up = $bdd->QUERY('SELECT avis FROM PartnerGBAF WHERE avis="good" and idName="' . $idName . '"');

                while ($data = $req_up->fetch()) {
                    $comments_up[] = $data;
                }

                return $comments_up;

        }

         public function list_down($idName)
        {
            $bdd = $this->dbConnect();

            $req_down = $bdd->QUERY('SELECT avis FROM PartnerGBAF WHERE avis="bad" and idName="' . $idName . '"');

                while ($data = $req_down->fetch()) {
                    $comments_down[] = $data;
                }

                return $comments_down;
        }

        public function add_avis($idName,$auteur ,$avis){

            $bdd = $this->dbConnect();

            $reqAvis = $bdd->QUERY('SELECT avis FROM PartnerGBAF WHERE auteur="' . $auteur . '"and idName= "' . $idName . '"');

            if($data = $reqAvis->fetch()){

                $message = 'vous avez déjà donné votre avis';
                return $message;

            }else{
                $req = $bdd->prepare('INSERT INTO PartnerGBAF (idName, auteur, date_creation, avis) VALUES (:idName, :auteur, NOW(), :avis)');
                $req->execute(array(
                'idName' => $idName,
                'auteur' => $auteur,
                'avis' => $avis
                ));
            }
        }
}
