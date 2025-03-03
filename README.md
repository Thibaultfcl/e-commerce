# Film&Chill

Film&Chill est une application web de commerce électronique pour acheter des films en ligne. Les utilisateurs peuvent parcourir les films, rechercher des films, ajouter des films à leur panier, passer des commandes et consulter l'historique de leurs commandes.

## Fonctionnalités

- Affichage des derniers films ajoutés
- Recherche de films par titre
- Affichage des détails d'un film
- Affichage des films par catégorie
- Affichage des détails d'un acteur et des films dans lesquels il a joué
- Ajout de films au panier
- Validation des commandes
- Affichage de l'historique des commandes
- Inscription et connexion des utilisateurs
- Tableau de bord administrateur pour gérer les utilisateurs et les commandes

## Installation

1. Configurez la base de données en modifiant le fichier [database.php] avec vos informations de connexion.

2. Créez un fichier `.env` dans le répertoire [config](http://_vscodecontentref_/2) et ajoutez votre clé API de The Movie Database (TMDb) :
    ```
    API_KEY=your_api_key_here
    ```

3. Démarrez votre serveur web (par exemple, XAMPP ou WAMP) et accédez à l'application via `http://localhost/e-commerce`.

## Utilisation

- Accédez à la page d'accueil pour voir les derniers films ajoutés.
- Utilisez la barre de recherche pour trouver des films par titre.
- Cliquez sur un film pour voir ses détails et l'ajouter au panier.
- Connectez-vous ou inscrivez-vous pour passer des commandes et consulter l'historique de vos commandes.
- Les administrateurs peuvent accéder au tableau de bord pour gérer les utilisateurs et les commandes.

