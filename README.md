# garage_v_parrot
## Démarche à suivre pour exécution en local
### Création de la Base de Données
Un fichier d'installation de la base de donnée est fournie dans le dossier install/gparrotSql.txt ou alors ci-dessous : 

    -- Création de la base de données gparrot.
    CREATE DATABASE gparrot;
    
    -- Utilisation de la base de données gparrot.
    USE gparrot;
    
    -- Création de la table avis_clients
    CREATE TABLE avis_clients (
      id INT(11) NOT NULL AUTO_INCREMENT,
      nom VARCHAR(100) NOT NULL,
      commentaire TEXT NOT NULL,
      note INT(11) NOT NULL,
      approved TINYINT(1) DEFAULT 0,
      PRIMARY KEY (id)
    );
    
    -- Création de la table cars.
    CREATE TABLE cars (
      id INT(11) NOT NULL AUTO_INCREMENT,
      img VARCHAR(255) DEFAULT NULL,
      modele VARCHAR(255) DEFAULT NULL,
      prix DECIMAL(10,2) DEFAULT NULL,
      annee INT(11) DEFAULT NULL,
      energie VARCHAR(50) DEFAULT NULL,
      kilometrage INT(11) DEFAULT NULL,
      description TEXT DEFAULT NULL,
      securite TEXT DEFAULT NULL,
      places TEXT DEFAULT NULL,
      options_list VARCHAR(255) DEFAULT NULL,
      create_at DATETIME DEFAULT NULL,
      PRIMARY KEY (id)
    );
    
    -- Création de la table Horaires.
    CREATE TABLE Horaires (
      id INT(11) NOT NULL AUTO_INCREMENT,
      jour ENUM('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche') NOT NULL,
      ouverture_matin TIME NOT NULL,
      fermeture_matin TIME NOT NULL,
      ouverture_apresmidi TIME NOT NULL,
      fermeture_apresmidi TIME NOT NULL,
      PRIMARY KEY (id)
    );

    -- Création de la table services.
    CREATE TABLE services (
      id INT(11) NOT NULL AUTO_INCREMENT,
      nom VARCHAR(255) NOT NULL,
      description TEXT DEFAULT NULL,
      PRIMARY KEY (id)
    );
    
    -- Création de la table users.
    CREATE TABLE users (
      id INT(11) NOT NULL AUTO_INCREMENT,
      username VARCHAR(255) NOT NULL,
      password VARCHAR(255) NOT NULL,
      role ENUM('admin', 'staff') NOT NULL,
      PRIMARY KEY (id)
    );


Si vous voulez avoir des exemples vous pouvez utiliser le fichier install/gparrot.sql

Dans les deux cas tout ce passe dans phpMyAdmin avve un lin qui devrait ressembler à ça http://localhost/phpMyAdmin5/



### Création d'un administrateur pour le back-office
Un aministrateur est déjà créé dans pour le back-office => admin: "userAdmin", 
                                                          password : "admin".




Créer un nouvel adminstrateur : 

<http://localhost/create_admin.php>

Si vous voulez effacer cet administrateur APRES avoir  créer votre nouvel administrateur :
Veuillez tapez cette ligne de commande dans phpMyAdmin

    DELETE FROM users
    WHERE role = 'admin'
  
  
