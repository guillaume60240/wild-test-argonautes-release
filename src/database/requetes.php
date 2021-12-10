<?php

function getAllArgonautes($db) 
{
    $sql = "SELECT * FROM argonaute";
    $requete = $db->prepare($sql);
    $requete->execute();
    $argonautes = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $argonautes;
}

function findByName($name, $db)
{
    $argonaute = $db->prepare('SELECT * FROM argonaute WHERE firstName = :name');
    $argonaute->bindValue(':name', $name, PDO::PARAM_STR);
    $argonaute->execute();
    $result = $argonaute->fetch();
    return $result;
}

function createArgonaute($name, $db)
{
    $sql = "INSERT INTO argonaute (firstName) VALUES (:firstName)";
    $requete = $db->prepare($sql);
    $requete->bindValue(':firstName', $name, PDO::PARAM_STR);
    $requete->execute();
}
