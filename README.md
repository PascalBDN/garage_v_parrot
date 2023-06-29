# garage_v_parrot
## Démarche à suivre pour exécution en local
### Création d'un administrateur pour le back-office
Un aministrateur est déjà créé dans pour le back-office => admin: "userAdmin", 
                                                          password : "admin".

Si vous voulez effacer cet administrateur afin d'en créer un autre :
Veuillez tapez cette ligne de commande dans phpMyAdmin

    DELETE FROM users
    WHERE role = 'admin'

Créer un nouvel adminstrateur : 

    INSERT INTO users (username, password, role)
    VALUES ('nouvel_admin', 'mot_de_passe', 'admin');





  
  
