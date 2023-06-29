# garage_v_parrot
## Démarche à suivre pour exécution en local
### Création de la Base de Données

Téléchargez le fichier gparrot.sql

### Création d'un administrateur pour le back-office
Un aministrateur est déjà créé dans pour le back-office => admin: "userAdmin", 
                                                          password : "admin".




Créer un nouvel adminstrateur : 

<http://localhost/create_admin.php>

Si vous voulez effacer cet administrateur APRES avoir  créer votre nouvel administrateur :
Veuillez tapez cette ligne de commande dans phpMyAdmin

    DELETE FROM users
    WHERE role = 'admin'
  
  
