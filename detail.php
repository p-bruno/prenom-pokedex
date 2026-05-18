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

// Récupère le paramètre d'url
$id = $_GET['pokemon_id'];

// Prépare le requête
$stmt = $connection->prepare("SELECT * FROM pokemon WHERE pokemon_id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

// Envoie la requête SQL à la BDD, recupérer (fetch) les résultats dans un tableau d'objet
$pokemon = $stmt->fetchAll(PDO::FETCH_OBJ);

echo "<pre>";
print_r($pokemon);
echo "</pre>";