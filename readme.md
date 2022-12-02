**Bataille 52 - Le jeu**

Les objectifs de l'exercice étaient : 

* 52 cartes, on simplifie en utilisant simplement des valeurs de 1 à 52
* les cartes sont mélangées et distribuées à 2 joueurs
* chaque joueur retourne la première carte de son paquet, le joueur disposant de la plus forte carte marque un point
* on continue jusqu'à ce qu'il n'y ait plus de carte à jouer
* on affiche le nom du vainqueur

Ce qui m'a posé problème : 
* L'utilisation stricte de PHP qui était possible mais vraiment pas sexy, une petite interface JS/CSS m'a vite parue indispensable 
* Sur le même principe, je me suis posée la question d'un jeu à lancer uniquement au terminal en PHP ? (vu qu'on pouvait comprendre la consigne comme ça) puis je me suis dit que normalement vous êtes tous un peu des devs et que faire tourner un index.php depuis un repo git, vous devriez y arriver !

Ce que j'aurais également pu faire pour aller plus loin :
- Un Form.class
- Passer en PHP 7.2 ou plus récent pour ajouter une surcouche de type sur toutes les fonctions
- Ajouter un bouton pour changer de prénom
- Utiliser des variables CSS
- Utiliser des cookies plutôt que des sessions, mais les gens aiment plus les cookies...

L'exercice peut donc être chargé localement avec la commande :

``git clone git@github.com:CamilleWemajin/bataille52.git``