<?php
/*
$mes = 'eJxzrHItCqn0zC8AABBiA2g=';
echo "mess de candy : ".$mes."<br>";

$bsq = base64_decode($mes);
echo "decodé en base64 : ".$bsq."<br>";

$dec = zlib_decode($bsq);
echo "decodé en zlib : ".$dec."<br>";
*/

// Joshua Linguet 20/04/2022

// ROOT ME - CHALLENGE - PROGRAMMATION - IRC - UMCOMPRESS ME

// Coder un bot irc qui recupère un message en base64 compressé avec zlib
// Répondre avec le message en clair

//bot - connexion
set_time_limit(0);
$socket = fsockopen('irc.root-me.org','6667');
if(!$socket){
    echo 'erreur';
    exit;
}
fwrite($socket, "USER gem gem gem gem\r\n");
fwrite($socket, "NICK gem\r\n");

$continuer = 1; // On initialise une variable permettant de savoir si on doit continuer la boucle.
while($continuer) // Boucle principale.
{

	$donnees = fgets($socket, 1024); // Le 1024 permet de limiter la quantité de caractères à recevoir du serveur.
	$retour = explode(':',$donnees); // On sépare les différentes données.
	// On regarde si c'est un PING, et, le cas échéant, on envoie notre PONG :
	if(rtrim($retour[0]) == 'PING')
	{
		fwrite($socket,'PONG :'.$retour[1]);
		$continuer = 0;
	}
	//if($donnees)
	//	echo "le serveur a envoyé : $donnees 000 <br>";
}
//echo "<br><br><br><br><br>";

//fwrite($socket,"JOIN #root-me_challenge\r\n");
fwrite($socket, "PRIVMSG Candy :!ep4\r\n");

//bot - programme principal

$donnees = fgets($socket,1024);
$mesen2 = explode(":", $donnees);
$bsq = base64_decode($mesen2[2]);
$rep = zlib_decode($bsq);
fwrite($socket, "PRIVMSG Candy :!ep4 -rep ".$rep."\r\n");
echo "candy a envoyé = ".fgets($socket,1024)." 000\n";



?>
