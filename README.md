 <!-- Générateur de Mot de Passe Sécurisé -->

![License](https://img.shields.io/badge/Licence-MIT-green.svg)
![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)

Une application web permettant de générer des mots de passe sécurisés selon des critères personnalisables, développée avec le framework Laravel.

 <!-- Fonctionnalités -->

 <!-- Fonctionnalités principales -->
    -Choix de la longueur du mot de passe (4 à 32 caractères)
    -Inclusion/exclusion de différents types de caractères:
    -Lettres majuscules (AZ-)
    -Lettres minuscules (az-)
    -Chiffres (09-)
    -Symboles (!@#$%^&*...)
    -Génération aléatoire sécurisée
    -Affichage du mot de passe généré

<!-- Fonctionnalités bonus -->
    -Indicateur visuel de force du mot de passe
    -Historique local des mots de passe générés
    -Interface responsive et moderne
    -Mode sombre/clair
    -Copie dans le presse-papier avec confirmation
    -Sauvegarde automatique dans le localStorage

 <!-- Technologies utilisées -->

    -Backend: Laravel 10.37.3
    -Frontend: HTML5, CSS3, JavaScript vanilla
    -Stockage: localStorage pour l'historique
    -Design: CSS custom sans frameworks externes

  <!-- Installation -->

    1. Cloner le repository:
    
    git clone 

    2.  Installer les dépendances Composer:
        composer install

    3. Configurer l'environnement (optionnel pour ce projet simple):
        cp .env.example .env
        php artisan key:generate

    4. Démarrer le serveur de développement:
        php artisan serve

    5. Ouvrir votre navigateur à l'adresse: http://localhost:8000

  <!-- Utilisation -->

    1. Ajustez la longueur souhaitée avec le curseur

    2. Cochez les types de caractères à inclure

    3. Cliquez sur "Générer" pour créer un nouveau mot de passe

    4. Utilisez "Copier" pour le mettre dans votre presse-papier

    5. Consultez l'historique pour retrouver vos anciens mots de passe

<!-- Structure du projet  -->
    
    /resources/views/password-generator.blade.php  # Vue principale
    /public/css/app.css                           # Styles CSS
    /public/js/app.js                             # Script JavaScript
    /routes/web.php                               # Routes Laravel

<!-- Déploiement -->

    1. Configurer le serveur web (Apache/Nginx) pour pointer vers le dossier /public
    2. S'assurer que les réécritures d'URL sont activées
    3. Définir l'environnement en production dans le .env

<!-- Auteur -->

    Développé par BOUKARI S.M. Nâïlou dans le cadre d'un test technique.
