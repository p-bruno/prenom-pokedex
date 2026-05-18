<?php
require_once __DIR__ . '/vendor/autoload.php';

// Charge les variables du fichier .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
try {
    // DNS (Data Name Source), c'est le point d'entrée pour accéder à la BDD
    $dns = "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']};";
    // mysql => indique le moteur de la BDD
    // host=localhost => l'adresse du serveur
    // dbname=studio_exemple => nom de la base de données
    $options = [
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    PDO::MYSQL_ATTR_SSL_CA => true,
    ];

    // Crée l'objet PDO pour se connecter
    $connection = new PDO( $dns, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $options);
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
    echo ("<img src='{$pokemon->pokemon_img}'>");
    echo ("<h1> {$pokemon->pokemon_id}, {$pokemon->pokemon_nom} </h1>");
}
?>