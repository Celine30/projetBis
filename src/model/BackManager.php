<?php


namespace Project\Model;



class BackManager extends Manager
{
    public function userQuestion($username)
    {
        $bdd = $this->dbConnect();
        $reqQuestion = $bdd->QUERY('SELECT question FROM userbank WHERE username="'.$username.'"');
        $data = $reqQuestion->fetch();

        $question=$data['question'];
        return $question;

    }

  public function userReponse($username)
    {
        $bdd = $this->dbConnect();
        $reqAnswer = $bdd->QUERY('SELECT reponse FROM userbank WHERE username="'.$username.'"');
        $data = $reqAnswer->fetch();

        $answer = $data['reponse'];
        return $answer;

   }

   public function resetPassword($username,$password)
   {
       $bdd = $this->dbConnect();
       $bdd->exec('UPDATE userbank SET password = "'.$password.'" WHERE username = "'.$username.'"');
   }

   public function checkPassword($username)
   {
       $bdd = $this->dbConnect();
       $reqMdp = $bdd->QUERY('SELECT password FROM userbank WHERE username="'.$username.'"');
       $data = $reqMdp->fetch();

       $Mdp = $data['password'];
       return $Mdp;
   }
}