<?php
$id = $_GET['pokemon_id'];


require_once __DIR__ . '/vendor/autoload.php';
//Charge les variables du fichier .env
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
    // Utilisateur avec lequel se connecter a la BDD
    $utilisateur = $_ENV['DB_USER'];
    $motDePasse = $_ENV['DB_PASSWORD'];

    // Crée l'objet PDO pour se connecter
    $connection = new PDO( $dns, $utilisateur, $motDePasse, $options);
} catch ( Exception $e ) {
    echo "Connection à la BDD impossible : ", $e->getMessage();
    die();
}

// Prépare le requête
$select = $connection->prepare("SELECT * FROM pokemon WHERE pokemon_id= :id");
$select->bindValue(':id', $id, PDO::PARAM_INT);
$select->execute();

// Envoie la requête SQL à la BDD, recupérer (fetch) les résultats dans un tableau d'objet
$pokemons = $select->fetchAll(PDO::FETCH_OBJ);

// echo "<pre>";
// print_r($pokemons);
// echo "</pre>";

$pokemon = $pokemons[0];

echo "
    <h2>{$pokemon->pokemon_nom}</h2>
    <img src='{$pokemon->pokemon_img}' alt='Image du pokemon' width='200'>
    <p>Poids : {$pokemon->pokemon_poids} kg </p>
    <p>Taille : {$pokemon->pokemon_taille} m </p>
    <p>Description : {$pokemon->pokemon_description}</p>
";

