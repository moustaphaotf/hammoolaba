# hammoolaba
Un site d'information

Programmé par une équipe de jeunes Guinéens.
Dans le cadre d'un projet de groupe à rendre pour une première.

# Configuration d'origine
MySQL : >= 8.0
PHP : >= 8.0


# Comment configurer le dossier de travail ?
MySQL :
  Creer une base de données 'hammoolaba_db'
  Ouvrir le fichier config.php et modifier les variables :
    $uname et $pword comme vous voulez en s'assurant que c'est un utilisateur existant et ayant accès à la base de données 'hammoolaba_db'
  Importer les données de la base de données dont le script se trouve dans le fichier hammoolaba_db.sql

PHP :
  Rien de particulier à configurer ...

# Vous voulez contribuer ?
Après la configuration

# créer une branche avec la commande
git branch <nom_branche>

# déplacez-vous sur cette branche
git checkout <nom_branche>

# apportez vos modifications et commitez
git add <fichiers_a_ajouter>
git commit -m <commentaire_sur_commit>