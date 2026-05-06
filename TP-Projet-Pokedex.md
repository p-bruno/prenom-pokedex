## TP : Création d'un Pokédex

---

### Étape 1 : Création du depo GitHub
* Créer un dépôt public sur GitHub avec un `README.md`.
* Cloner le projet dans le répertoire de travail (Wamp/www).
* Créer un fichier `index.php` affichant "Hello World", commiter et pusher.

### Étape 2 : Création de la BDD dans TiDB Cloud
* Créer le MCD de la BDD. Une fois fait, importer le schéma dans le readme de GitHub.   
* Créer un cluster sur **TiDB Cloud** intitulé "Pokedex".
* Importer les tables et les données dans le cluster via les fichiés CSV fournis.

### Étape 3 : Connection avec la BDD TiDB Cloud avec PHP PDO
*    Utiliser PDO pour établir la connexion.
* Commiter et pusher.
~~~php
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
~~~



### Étape 4 : Récupération des pokemon 
* Dans TiDB tester la requête    `SELECT` pour récupérer le nom et l'image des Pokémon
* Dans `index.php`, effectuer une requête `SELECT` pour récupérer le nom et l'image des Pokémon.
*   Boucler sur les résultats pour afficher une liste simple.
* Commit : "Feat: affichage de la liste des pokemons".

### Étape 5 : Page de Détails
*    Créer `detail.php`.
*    Sur `index.php`, créer des liens de type `detail?id=1`.
*    Dans `detail.php`, récupérer l'ID via `$_GET`.
* **Sécurité :** Utiliser impérativement une **requête préparée** (`prepare` / `execute`) pour éviter les injections SQL.
* **Challenge :** Faire une jointure (`JOIN`) pour afficher les types et les statistiques du Pokémon sélectionné.

### Étape 6 : UX/UI (Libre)
*    Améliorer le style de votre site en utilisant l'outil de votre choix (ChatGPT, CSS pur, bootstrap etc...). Exemple : https://brunopokedex.vercel.app/

### Étape 7 : Déploiement et Routage (Vercel)
* Mettre tous les fichiers du projet (index.php, detail.php) dans un dossier /api   
* Créer un fichier `vercel.json` à la racine pour configurer le runtime PHP et les routes (URL propres sans `.php`).
*    Connecter le compte GitHub à Vercel et importer le dépôt.
*    Configurer les **Environment Variables** sur le tableau de bord Vercel (copier les valeurs du `.env`).

### Étape 8 : Finalisation et Documentation
*    Mettre à jour le `README.md` avec une capture d'écran du projet et le lien URL vers le site en production.
*    Tester la navigation et s'assurer que le lien GitHub dans le profil fonctionne.

### Devoirs à la maison
L'objectif est de créer un site web qui ressemble au projet Pokedex. Le principe est donc de créer un site de type "encyclopédie" sur le thème de votre choix.
1) Choisir le thème de votre choix (celui qui vous plaît le plus). Par exemple : créer une encyclopédie sur les jeux vidéos, une encyclopédie sur les films, sur les pays etc....
Si vous n'avez vraiment aucune idée, alors voici le thème que vous choisirez : une encyclopédie sur les pièces de monnaie de 2€.
Contexte : Dans la vie quotidienne on utilise souvent des pièces de 2€. Votre client souhaite que vous créer un site afin de répertorié toutes les pièces de 2€ présentent dans la zone euro. Ainsi la prochaine fois que votre client aura en main une pièce de 2€ et qu'il pense que cette pièce a de la valeure. Alors il pourra consulter votre site pour connaitre son prix sur le marché. Voici un exemple du résultat final : https://www.collectiondemonnaie.net/euro/2/cotation_et_valeur_2_euro_commemorative.html

2) Coder la premièver version de votre site (la V1) : 
-  Création du depo GitHub
- Création de la BDD dans TiDB Cloud
- Connection avec la BDD TiDB Cloud avec PHP PDO
- Récupération des pokemons/données pour les afficher sur votre page web. 