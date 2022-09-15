<?php
// Joshua Linguet 17/04/2022

// ROOT ME - CHALLENGE - PROGRAMMATION - IRC - CHAINE ENCODEE

// Coder un bot irc qui recupère un message en base64
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
	if($donnees)
		echo "le serveur a envoyé : $donnees 000 <br>";
}
echo "<br><br><br><br><br>";

//fwrite($socket,"JOIN #root-me_challenge\r\n");
fwrite($socket, "PRIVMSG Candy :!ep2\r\n");

//bot - programme principal

$donnees = fgets($socket,1024);
$mesen2 = explode(":", $donnees);
$rep = base64_decode($mesen2[2]);
fwrite($socket, "PRIVMSG Candy :!ep2 -rep ".$rep."\r\n");
echo "candy a envoyé = ".fgets($socket,1024)." 000\n";

?>