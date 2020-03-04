# Jeedom_Suppression-capture-camera

Dans un premier temps on va repérer le dossier où sont stockées les captures, pour cela, on se connecte en SSH à jeedom (via puTTY par exemple) :
Dans Host Name(or IP adress), tapez l’IP de votre Jeedom (port de connection : 22)
 
Pour rappel les ID de connexion par défaut sont :
Login : pi
password : raspberry
Puis vous tapez la ligne de commande suivante : ls /var/www/html/plugins/camera/data/records/
Vous devriez voir des dossiers apparaitre portant des noms à 3 chiffres.
 
Chaque dossier (avec nom à 3 chiffres) correspond aux captures d’une caméra.
Pour repérer quel dossier contient les captures de tel ou tel caméra, vous pouvez rentrer dans le dossier et regarder le nom des captures (dans le nom de la capture apparait le nom de la caméra donnée dans le plugin caméra). Pour cela, vous tapez la commande ls /var/www/html/plugins/camera/data/records/ et le nom du dossier 
Exemple ls /var/www/html/plugins/camera/data/records/124
 
On voit le nom des captures et on peut repérer pour quel caméra le dossier est créé. Faire cette étape pour chaque dossier. 
Notez-vous : 
/var/www/html/plugins/camera/data/records/XXX/ => Camera 1
/var/www/html/plugins/camera/data/records/XXX/ => Camera 2
/var/www/html/plugins/camera/data/records/XXX/ => Camera 3
On utilisera ces liens plus tard.

On en a fini avec PuTTY.

Maintenant il faut créer le scénario qui va supprimer les captures
Pour cela, connectez vous à l’interface jeedom puis dans outils, scénarios

Cliquez sur Ajouter puis donnez un nom a votre scénario (par exemple Suppression capture CameraIP_Salon), renseigner les autres infos si vous le désirez. Remplissez ensuite la partie mode du scénario. Nous voulons que le scénario se lance tous les jours à 00:01
Passons ensuite à la partie scénario. Ajoutez un bloc de type code

Puis passons à l’écriture du code. Renseigner dans la partie code les données que vous trouverez dans scénario.php :

Je ne m’attarderais par sur l’explication du code. Veuillez simplement renseigner les données propres à votre jeedom. A savoir :
Adresse IP de votre jeedom
ID de connexion SSH (le même que pour vous connecter avec puTTY)
Mot de passe de connexion SSH (le même que pour vous connecter avec puTTY)
Nombre de jour que vous voulez conserver.
Lien vers les enregistrements : il faut mettre à cette endroit le lien que vous avez trouvez au début du tuto pour la caméra dont le scénario est créé.
Le reste n’est pas à toucher.
Vous pouvez maintenant enregistrer le scénario.
ATTENTION CE SCENARIO VA SUPPRIMER UNIQUEMENT LES ENREGISTREMENTS : AUJOURD’HUI MOINS NBR DE JOUR QUE VOUS VOULEZ CONSERVER (par exemple supprimer tous les enregistrements du 2019-06-18). LES ENREGISTREMENTS PRECEDENT CE JOUR (inférieur à la date du 2019-06-18) NE SERONT PAS SUPPRIMER, IL FAUT LES SUPPRIMER MANUELLEMENT DANS LE PLUGIN CAMERA. CETTE MANIP N’EST A FAIRE QU’UNE SEUL FOIS.

Veuillez dupliquer ce scénario pour chaque caméra faisant des enregistrements dans le plugin caméra. Il faudra à chaque fois uniquement changer le lien vers les enregistrements dans la partie code (changer le nom du dossier à 3 chiffres et mettre celui qui correspond à la caméra en question) et changer les paramètres si vous le souhaitez (Nombre de jour conservé)
