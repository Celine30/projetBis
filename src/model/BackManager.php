<?php


namespace Project\model;



class BackManager extends Manager
{
    public function userQuestion($username)
    {
        $bdd = $this->dbConnect();
        $reqQuestion = $bdd->QUERY("SELECT question, reponse FROM userbank WHERE username='$username'");
        $data = $reqQuestion->fetch();

        $_SESSION['question'] = $data['question'];
        $_SESSION['reponse'] = $data['reponse'];

    }

}