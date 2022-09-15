<?php
// Joshua Linguet 17/04/2022

// ROOT ME - CHALLENGE - PROGRAMMATION - IRC - LA ROUE ROUMAINE

// Coder un bot irc qui recupère un message en rot13
// Répondre avec le message en clair

// j'ai codé ma propre fonction pour le rot13 parce que je m'ennui mais j'aurais pu utiliser str_rot13()
function rot13($mes){
    $ames = str_split($mes);
    for($i=0; $i<strlen($mes); $i++){
        $va = ord($ames[$i]);
        if( ($va>=65) && ($va<=77) || ($va>=97) && ($va<=109) )
            $ames[$i] = chr(ord($ames[$i]) + 13);
        if( ($va>=78) && ($va<=90) || ($va>=110) && ($va<=122) )
            $ames[$i] = chr(ord($ames[$i]) - 13);
    }
    $ames = implode($ames);
    return $ames;
}

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
fwrite($socket, "PRIVMSG Candy :!ep3\r\n");

//bot - programme principal

$donnees = fgets($socket,1024);
$mesen2 = explode(":", $donnees);
$rep = rot13($mesen2[2]);
fwrite($socket, "PRIVMSG Candy :!ep3 -rep ".$rep."\r\n");
echo "candy a envoyé = ".fgets($socket,1024)." 000\n";


?>
