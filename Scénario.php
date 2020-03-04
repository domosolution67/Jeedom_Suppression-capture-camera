$Hostname = '192.168.X.X'; //Adresse IP de la machine sur laquelle sont stocké les captures
$Username = 'XXXXXXXX'; //Identifiant de connection SSH
$Password  ='XXXXXXX'; //Mot de passe de connection SSH
$Nbr_Jour_Conserve = '7'; //Nombre de jour à conserver
$Nbr_Jour_Conserve_UNIX = $Nbr_Jour_Conserve * '72000' + '7200' ; // Conversion NBR_JOUR_Conserve au format UNIX
$Lien_Enreg = '/var/www/html/plugins/camera/data/records/124/'; //Lien absolue (depuis la racine) vers les enregistrement
$Commande_SSH = 'sudo rm'; //Commande SSH pour la suppression des fichiers
$Jour_Suppri_Sans_Tirait = date('omd',strtotime(date('omd')) - $Nbr_Jour_Conserve_UNIX) ; //Calcul de la date du jour moins le nombre de jour conservé
$Jour_Suppri_Ajout_Tirait = substr_replace($Jour_Suppri_Sans_Tirait, "-", 4, 0); // Ajout d'un tirait entre l'année et le mois
$Jour_Suppri_Avec_Tirait = substr_replace($Jour_Suppri_Ajout_Tirait, "-", 7, 0); // Ajout d'un tirait entre le mois et le jour
$Command = $Commande_SSH." ".$Lien_Enreg."*".$Jour_Suppri_Avec_Tirait."*" ; //Definition de la commande SSH
$scenario->setData('Commande SSH CameraIP_Salon1',$Command); //Affection de la valeur de la commande SSH à la variable Command

$ssh = ssh2_connect($Hostname, 22);
ssh2_auth_password($ssh, $Username, $Password);
$stream = ssh2_exec($ssh, $Command);
stream_set_blocking($stream, true);

//renvoi la sortie de la commande si besoin
$response = '';
while($buffer = fread($stream, 4096)) {
$response .= $buffer;
}
 
fclose($stream);
echo $response;
