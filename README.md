# garage_v_parrot
## Démarche à suivre pour exécution en local
### Création de la Base de Données
Un fichier d'installation de la base de donnée est fournie dans le dossier install/gparrotSql.txt

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
  
  
