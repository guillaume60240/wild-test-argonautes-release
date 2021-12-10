<?php

function getPDO(){

    require('variable.php');

    try {
        $bdd = new PDO('mysql:host='.$host.';dbname='.$dbName.';charset=utf8', $userName , $mdp);
        $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bdd;
    }
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }
}