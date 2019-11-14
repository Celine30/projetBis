<?php


namespace Project\Model;


class ChangeManager extends Manager
{

    public function change_username($username_change, $username){
        $bdd = $this->dbConnect();
        $bdd->exec('UPDATE userbank SET username = "'.$username_change.'" WHERE username = "'.$username.'"');
    }

       public function change_nom($nom_change, $username){
        $bdd = $this->dbConnect();
        $bdd->exec('UPDATE userbank SET nom = "'.$nom_change.'" WHERE username = "'.$username.'"');
    }
       public function change_prenom($prenom_change, $username){
        $bdd = $this->dbConnect();
        $bdd->exec('UPDATE userbank SET prenom = "'.$prenom_change.'" WHERE username = "'.$username.'"');
    }

        public function change_password($password_change, $username){
        $bdd = $this->dbConnect();
        $bdd->exec('UPDATE userbank SET password = "'.$password_change.'" WHERE username = "'.$username.'"');
    }



}