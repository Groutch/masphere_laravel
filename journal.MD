
Lundi :
Nous avons commencé à prendre en main le projet, installé celui-ci sur nos machines, il y a eu quelques erreurs lors de l'installation avec composer.
Nous nous sommes aussitôt lancé sur le trello pour avoir nos tâches avec comme base l'intervention de la personne qui était venu et nos connaissances.
Ensuite nous avons initié le Planning Poker avec un indice disposé en Heures !
Nous avons aussi jeté un oeil sur la base de donnée qui nous paraît complexe à prendre en main

Mardi : 

Pour cette deuxième journée nous avons décidé de rendre fonctionnelles certaines fonctions qui étaient déjà présente dans le code mais qui ne pouvaient pas marcher.
Suite à ça nous avons pu lancer un audit sur un échantillon du projet plus conséquent, ce qui etait plus interessant que de le faire sur la moitié accessible du projet la veille.
Après cette audit nous avons constaté une lenteur du projet que nous soupçonnons être à cause de la BDD de Heroku , donc nous sommes passés avec la même modélisation mais sur Mysql et GearHost, maigre gain de perfomances pour le moment, le projet est trop volumineux pour qu'on puisse trouver toutes les sources de problèmes encore à l'heure actuelle.

Mercredi :

Aujourd'hui nous avons donc décidé de modifier un peu d'affichage, donc une refonte de l'UX qui était en contraste violent avec l'UI qui elle était bien travaillée.
Nous avons fini notre journée sur une nouvelle modélisation de base de données, avec cas d'utilisation , cardinalités etc... afin de rendre selon nous le projet plus performant. Nous avons pu lier cette nouvelle base de donnée sans trop d'encombres à notre projet mais malheureusement il y a quelques problèmes avec le code actuel du projet, nous calculons donc si il est réellement rentable de repartir sur un tout nouveau système.

Jeudi :

Après mures réflexions , nous nous sommes décidés à rester sur la modélisation qu'avait fait notre prédécesseur car le travail effectué par ce dernier etait d'une quantité innombrable et si il a réussi à travailler avec alors nous aussi, au prix de la performance de l'application qui était elle devenu incroyable. Nous avons tout de même conservé notre SGBD (Mysql) et Gearhost. Nous avons continué les fix , notamment le mot de passe oublié qui est désormais fonctionnel et avons créer une route qui est vide pour le moment mais qui permettra d'acceder aux profils des utilisateurs du site. 

Vendredi :

Pour continuer sur la lancée de la veille, nous avons décidé de gérer ce profil et de nous mettre d'accord sur ce que nous allions laissé apparaître sur le profil, il en ressort que nous laissons le nom , le mail, le role ainsi que les évènements auxquels participe la personne en question. Nous avons donc commencé à mettre en place de manière simplement fonctionnelle sans travail visuel ce schéma, et nous avons aussi débuté la map de tout les évènements. Nous avons aussi initié les status de requetes de garde, une famille désormais envoie une demandé que le pro de garde peut accepté ou refuser ! Contrairement à avant où ce même pro ne voyait que un commentaire de la personne. Nous sommes réellement lent, le groupe est confronté à un framework très varié et différent de ce que l'on fait habituellement couplé à une base de donnée tentaculaire.

Premier Weekend : (les week ends seront considérés comme deux jours en un)

Nous avons donc continué le coté utilisateur, après son profil fonctionnel nous avons rendu possible pour cet utilisateur le fait qu'il puisse modifier ses informations, pas son rôle en revanche. La map des évènements et maintenant finie et fonctionnelle, il ne restera plus qu'à l'habiller. Sur ce week end nous avons surtout appris à comprendre le framework PHP et notre utilisation et de ce fait plus efficace.

Lundi :

Etant donné que nous sommes désormais habitué à Laravel nous avons donc pu nous pencher sur plusieurs fonctions, nous avons mis une sécurité sur le changement des infos de l'utilisateur, nous lui demandons son mot de passe avant de changer ses informations, on ne sait jamais si son ordinateur est verouillé et que quelqu'un d'autre y a accès, c'est dangereux. Nous avons donc ajouté le titre des évènements sur la carte globale de ceux-ci sur un petit popup pour savoir de quelle évènement il s'agit !
Mise en place d'un email automatique entre les pro de garde et les familles lorsqu'il y a un changement d'état, donc à la demande d'une garde, à la validation ou au refus de celle-ci aussi.
Nous nous sommes décidé à nettoyer le code car l'application est lente et nous sommes en difficulté pour les modifications de style qui mettent longtemps à s'ffectuer.
Nous avons donc passé du temps sur les routes. En passant sur les routes nous nous sommes arrété sur le profil utilisateur, afin de l'harmoniser, il y avait des différences de vues et de controlleur trop importantes qui étaient trop couteuse pour rien.

Mardi :

Suite aux ajouts de la veille, nous avons constaté un problème sur le mail provider, nous avons donc changé pour un plus performant et moins contraignant.
Nous avons repris notre nettoyage du code qui nous prend un temps monstre sur le projet, tout comme la prise en main de celui ci, nous devons étudié chaque controller, chaque route pour vérifier si elles sont necessaires réellement et ce n'est pas le cas, nous avons donc fini le sanitize et nous sommes a une centaine de lignes retirés sur l'ensemble du projet, c'est rassurant tout est fonctionnel !
Nous avons ensuite passé du temps sur le profil car le profil est le même pour une famille ou un(e) assistant(e) maternel(le). Nous avons donc prévu dans les deux cas le code adapté pour afficher tout les évènements liés à cette personne.
Nous avons donc vu un petit problème lorsque une personne etait déjà inscrit sur une garde et l'avons corrigé, les requêtes sont très longues car nous devons passé par un nombre de tables ahurissant.

Mercredi :

La journée fut courte car tout notre groupe s'est déplacé à un évènement l'après midi, mais le matin nous avons enclenché le pas rapidement pour produire un minimum de travail , nous avons ecrit la fonction pour supprimer une garde, et tout comme la requete de la veille elle fût rude car en supprimant la garde nous devons aussi supprimer les requetes de garde associés et les tables associatives qui sont sur le chemin, d'un autre coté nous avons démarré la fonction pour supprimer une demande de garde.

Jeudi :
Nous avons fini la suppression d'une demande de garde, nous avons commencé à réfléchir aux méthodes de financements et donc les avons noté sur un fichier MD dans le projet, nous avons trouvé en travaillant encore des morceaux de commentaire inutilisés, donc nous les avons supprimé. Nous nous sommes encore une fois attaqué à une grosse partie, la suppression d'un évènement , et cette fonction est gigantesque car elle doit supprimer toutes les gardes associés, qui elles mêmes supprimeront les demande de garde associés, et toutes ont des tables associatives. Sur 12 tables présentes dans le projet nous avons dû passé par 8 tables pour cette fonction, et nous ne sommes pas sûrs que tout soit opérationel, mais pas de problème apparent sur l'utilisation de l'application.

Vendredi :

En fin de compte la suppression d'un évènement comportait un problème visible uniquement dans la base de données, certaines entrées n'étaient pas supprimés comme convenu, et les gardes non plus ce qui empêchait la création d'une nouvelle garde sur un évènement où nous avions au préalable supprimé notre garde. Nous avons donc revu à tête reposée ces deux fonctions afin de les corriger et elles sont désormais fonctionnelles sans faille. Nous avons aussi changé des redirections qui n'étaient pas convenables, un organisateur tombait sur la page recherche d'évènement lors de sa connexion , ou après avoir créer un évènement alors que c'est impossible depuis l'interface que lui offre l'application, nous avons donc décidés de lui empêcher l'accès aux pages recherches d'évènements.

WeekEnd:

Nous avons vu rapidement l'audit du projet, les performances ne pouvant être améliorés nous avons vu l'accesibilité qui elle le pouvait afin qu'elle soit moins problématique, le référencement. Les bonnes pratiques étant à un seuil très acceptable et la PWA à un seuil logique nous les avons laissés tels quels.