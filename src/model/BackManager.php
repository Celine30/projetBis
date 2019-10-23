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

     public function add_com($idName, $comment, $auteur, $avis)
     {
            $bdd = $this->dbConnect();
            $req = $bdd->prepare('INSERT INTO PartnerGBAF (idName, comment, auteur, date_creation, avis) VALUES (:idName, :comment, :auteur, NOW(), :avis)');
            $req->execute(array(
                'idName' => $idName,
                'comment' => $comment,
                'auteur' => $auteur,
                'avis' => $avis
            ));
            $comment='valide';
            return $comment;
        }

        public function list_com($idName){
            $bdd = $this->dbConnect();
            $reqlist = $bdd->QUERY('SELECT comment, auteur, date_creation, avis FROM PartnerGBAF WHERE idName="' . $idName . '"');
            $data = $reqlist->fetch();

            return $data;
        }
}
