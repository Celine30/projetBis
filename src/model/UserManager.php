<?php

namespace Project\model;

/**
 * Class UserManager
 * @package Project\model
 */
class UserManager extends Manager
{
    /**
     * @param $last_name
     * @param $first_name
     * @param $username
     * @param $user_password
     * @param $question
     * @param $answer
     */
    public function userControl($last_name, $first_name, $username,$user_password,$question,$answer )
    {
        $bdd = $this->dbConnect();

        $controlOne = $bdd->QUERY("SELECT username FROM userbank WHERE username='$username'");
        if ($data = $controlOne->fetch()) {
            echo ' username existe deja ';
            $controlOne = false;

        }

        $controlTwo = $bdd->QUERY("SELECT nom FROM userbank WHERE nom='$last_name'");
        if ($data = $controlTwo->fetch()) {
            $controlThree = $bdd->QUERY("SELECT prenom FROM userbank WHERE prenom='$first_name'");
            if ($data = $controlThree->fetch()) {
                echo ' / Nom et prénom existe deja ';
                $controlTwo = false;
            }
        }

        if (!$controlOne) {
            echo ' / ça marche ';
        }if (!$controlTwo) {
            echo ' / ça marche2 ';
        } else {

            $req = $bdd->prepare('INSERT INTO userbank (nom,prenom,username,password,question,reponse) VALUES (:nom, :prenom, :username, :password, :question, :reponse)');
            $req->execute(array(
                'nom' => $last_name,
                'prenom' => $first_name,
                'username' => $username,
                'password' => $user_password,
                'question' => $question,
                'reponse' => $answer

            ));

        }
    }
}