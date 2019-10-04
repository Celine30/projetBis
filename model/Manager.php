<?php
class Manager
{
    protected function dbConnect()
    {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $bdd;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}