Le projet est une application pour aider les femmes durant leurs grossesse.La base de donnée qui s'appelle baby_mama est déjà crée avec insertion des données dans conseils et symptomes(14 syptomes et conseils). Un medecin egalement a été rajouté par defaut. Les developpeurs front vont utiliser exactement les appelations comme ecrit dans la base de donnée pour faciliter la recuperation. Exemple:pour l'utilisatice utilisé nom, prénom .....ect. Ils vont creer tout le design dans le dossiers views/ et s'assurer que les liens (<a href= "....") vers les autres pages respectent les urls ci-dessous:
Page de départ | Action(bouton/lien) | URL de destination
index.php      | Bouton"S'inscrire"  | inscription.php
index.php      | Bouton"Se connecter"| connection.php
inscription.php| Envoyer formulaire  | ../auth/register.php
connection.php | Connecter           | ../auth/login.php
profil.php     | Bouton"Deconnexion" | ../auth/logout.php
admin_dashboard|                     | acceuil.php
dashboard.php  | icone journal       | journal.php
dashboard.php  | icone santé/symptome| symptomes.php

NB:  Le Front doit créer dans la page admin_dashboard accessible que par nous un tableau qui affiche la liste des utilisatrices, un bouton pour supprimer un compte, et un formulaire pour ajouter de nouveaux médecins ou conseils santé.
Voici ce qu'elle devrait contenir selon ton arborescence :
Gestion des Utilisatrices : Un tableau simple (Nom, Prénom, Email).
Gestion des Conseils : Un bouton pour modifier les textes liés aux symptômes.
Lien vers le site : Un bouton pour revenir a acceuil.
La page index c'est la premiere page que l'on voit celle de bienvenue.

En ce qui concerne les developpeurs, le developpeur 2 écrit le code PHP qui :

Calcule la semaine de grossesse (ex: "Semaine 20") à partir de la date enregistrée.
Récupère le conseil santé correspondant au dernier symptôme choisi.
Affiche l'alerte rouge si le symptôme enregistré est marqué comme "grave" dans ta base de données.
Pour le Développeur 2:
Il utilisera la table symptomes pour afficher la liste déroulante.
Il récupérera le niveau_alerte pour décider s'il doit afficher le bloc d'alerte rouge sur le acceuil.php.

Pour le Développeur 3:
Il utilisera la table journal pour enregistrer les note_libre et incrémenter les mouvements_bebe.
Le developeur 3 s'occupe de la partie journal_suivi qui contient note qui permet à l'utilisatrice de s'exprimer. Elle y met son ressentie, ce qu'elle veut. Elle y raconte comment elle vit sa grossesse. Mouvement du bébé est un compteur ^pour enregister le nombre de fois le bébé bouge.

NB:
Conseil de Responsable : Faite un système de "To-Do List" sur l'acceuil.

Le PHP vérifie la date du jour.

Si un rappel est prévu aujourd'hui, il s'affiche en haut du dashboard.php avec une petite icône de cloche 🔔.

En ce qui concerne la répartition c'est envoyé dans le groupe. Je nous souhaite un bon travail à nous toutes. BISOU MOUAH.