<?php
try {
    // DNS (Data Name Source), c'est le point d'entrée pour accéder à la BDD
    $dns = "mysql:host=gateway01.eu-central-1.prod.aws.tidbcloud.com;port=4000;dbname=bruno_pokedex;";
    // mysql => indique le moteur de la BDD
    // host=localhost => l'adresse du serveur
    // dbname=studio_exemple => nom de la base de données
    $options = [
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    PDO::MYSQL_ATTR_SSL_CA => true,
    ];
    // Utilisateur avec lequel se connecter a la BDD
    $utilisateur = 'ML59cW9tVcUNqvD.root';
    $motDePasse = 'S5OnMjy2ItYIPMZY';

    // Crée l'objet PDO pour se connecter
    $connection = new PDO( $dns, $utilisateur, $motDePasse, $options);
} catch ( Exception $e ) {
    echo "Connection à la BDD impossible : ", $e->getMessage();
    die();
}

// Prépare le requête
$select = $connection->query("SELECT * FROM pokemon;");

// Envoie la requête SQL à la BDD, recupérer (fetch) les résultats dans un tableau d'objet
$pokemons = $select->fetchAll(PDO::FETCH_OBJ);

foreach ($pokemons as $pokemon)
{
    echo ("<h1> {$pokemon->pokemon_id}, {$pokemon->pokemon_nom} </h1>");
}
?>