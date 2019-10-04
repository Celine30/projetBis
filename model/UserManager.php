<?php

require_once('model/Manager.php');

class UserManager extends Manager
{

    public function userInsert($last_name, $first_name, $username, $user_password,$question, $answer ){

        $bdd = $this->dbConnect();
        $req = $bdd-> prepare('INSERT INTO userbank (nom, prenom, username,password, question, reponse) VALUES (:nom, :prenom, :username,:password, :question, :reponse)');
        $req -> execute(array(
            'nom'=> $last_name,
            'prenom'=> $first_name,
            'username'=> $username,
            'password'=> $user_password,
            'question'=> $question,
            'reponse'=> $answer

        ));

    }

}