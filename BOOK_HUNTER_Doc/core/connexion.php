<?php
// CONNEXION 
// Ne pas oublier d'avoir chargé la DB en local sur Mamp 
try {
    $connexion = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    echo $e;
};
