<?php


namespace Project\Model;


class ChangeManager extends Manager
{

    public function change_username($username_change, $username){
        $bdd = $this->dbConnect();
        $bdd->exec('UPDATE userbank SET USERNAME = "'.$username_change.'" WHERE username = "'.$username.'"');
    }

       public function change_nom($nom_change, $username){
        $bdd = $this->dbConnect();
        $bdd->exec('UPDATE userbank SET nom = "'.$nom_change.'" WHERE username = "'.$username.'"');
    }
       public function change_prenom($prenom_change, $username){
        $bdd = $this->dbConnect();
        $bdd->exec('UPDATE userbank SET nom = "'.$prenom_change.'" WHERE username = "'.$username.'"');
    }



}