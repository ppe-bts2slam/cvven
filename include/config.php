<!DOCTYPE html>
<meta name="viewport" content="minimum-scale=1.0, maximum-scale=1.0">
<?php
// Démarrage des sessions
session_start();

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////                                                               /////////////////////////
/////////////////////////                        CONFIGURATIONS                         /////////////////////////
/////////////////////////                                                               /////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$base 				= "cvven"; 								// Nom de la base de données
$host 				= "localhost"; 							// Nom du serveur
$root 				= "root"; 								// Nom de l'utilisateur pour l'accès à la base de données
$pass 				= ""; 									// Mot de passe pour l'accès à la base de données
$smtp				= "smtp.numericable.fr"; 				// Adresse SMTP du serveur
$port_smtp			= 25; 									// Port SMTP du serveur
$url_root 			= "http://192.168.10.106/eden-france";	// Adresse du dossier du site
$url_home 			= "index.php"; 							// Nom du fichier de l'accueil
$design 			= "style.css"; 							// Nom du design
$favicon 			= "images/favicon.ico";					// Nom du favicon
$titre 				= "Eden France"; 						// Titre du site
$charset 			= "UTF-8";								// Encodage du site
$mail 				= "eden.france@yahoo.fr";				// Adresse email de l'administrateur (eden.france@yahoo.fr)
$admin 				= "admin";								// Login de l'administrateur
$password 			= "password";							// Mot de passe de l'administrateur
$code 				= "08452378";							// Code pour être artiste
$timeout 			= 43200;								// Timeout de session en secondes (12 heures)
$taille_maxi_video	= 52428800;								// Taille maxi pour les vidéos (50Mo)
$taille_maxi_musique= 31457280;								// Taille maxi pour les musiques (15Mo)
$taille_maxi_photo	= 10485760;								// Taille maxi pour les photos (5Mo)

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////                                                               /////////////////////////
/////////////////////////                     FIN DES CONFIGURATIONS                    /////////////////////////
/////////////////////////                                                               /////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Destructeur automatique de fin de session
if(isset($_SESSION['date_connect']))
{
	if((time()-$_SESSION['date_connect']) > $timeout)
	{
		header('Location: deconnexion.php');
	}
	
}

// Connexion à la base de données
$conn = mysql_connect($host,$root,$pass)
	or die("Connexion au serveur impossible");
$db = mysql_select_db($base)
	or die("Sélection de la base de données impossible");

// Encodage des requêtes SQL
mysql_query("SET NAMES 'utf8'");

// Appel de la fonction pour mettre un mot au pluriel
function pluriel($nb)
{
	if($nb > 1)
	{
		return "s";
	}
	else
	{
		return "";
	}
}

// Appel de la fonction pour connaître le type d'une url
function type_url($lien)
{
	$lien = explode("/", $lien);
	$lien['protocole'] = $lien[0];
	$lien['url'] = $lien[1];
	
	if($lien[0] == "http:")
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

// Appel de la fonction pour convertir la durée en mm:ss
function duree($duree)
{
	$minute = (int)($duree/60);
	$seconde = $duree - ($minute*60);
	$duree = $minute."min ".$seconde."sec ";
		
	return $duree;
}

// Appel de la fonction pour inverser le sens de la date
function date_inverse($date)
{
	$date = explode("-", $date);
	$date['annee'] = $date[0];
	$date['mois'] = $date[1];
	$date['jour'] = $date[2];
	$date = $date[2]."/".$date[1]."/".$date[0];
		
	return $date;
}

// Appel de la fonction pour inverser le sens de la date et de l'heure
function date_heure_inverse($date)
{
	$d = explode(" ", $date);
	$date = explode("-", $d[0]);
	$heure = explode(":", $d[1]);
	$date['annee'] = $date[0];
	$date['mois'] = $date[1];
	$date['jour'] = $date[2];
	$heure['heure'] = $heure[0];
	$heure['minute'] = $heure[1];
	$heure['seconce'] = $heure[2];
	$date = $date[2]."/".$date[1]."/".$date[0]." à ".$heure[0].":".$heure[1].":".$heure[2];
		
	return $date;
}

// Appel de la fonction pour séparer la date
function date_separation($date,$i)
{
	$i = $i - 1;
	$date = explode("-", $date);
	$date = $date[$i];
		
	return $date;
}

// Appel de la fonction pour séparer l'heure
function heure_separation($heure,$i)
{
	$i = $i - 1;
	$heure = explode("h", $heure);
	$heure = $heure[$i];
		
	return $heure;
}

// Appel de la fonction pour mettre la date au format RSS
function date_rss($date)
{
	$date = explode("-", $date);
	$date['annee'] = $date[0];
	$date['mois'] = $date[1];
	$date['jour'] = $date[2];
	
	if($date[1] == "01")
	{
		$date['mois'] = "Jan";
	}
	else if($date[1] == "02")
	{
		$date['mois'] = "Feb";
	}
	else if($date[1] == "03")
	{
		$date['mois'] = "Mar";
	}
	else if($date[1] == "04")
	{
		$date['mois'] = "Apr";
	}
	else if($date[1] == "05")
	{
		$date['mois'] = "May";
	}
	else if($date[1] == "06")
	{
		$date['mois'] = "Jun";
	}
	else if($date[1] == "07")
	{
		$date['mois'] = "Jul";
	}
	else if($date[1] == "08")
	{
		$date['mois'] = "Aug";
	}
	else if($date[1] == "09")
	{
		$date['mois'] = "Sep";
	}
	else if($date[1] == "10")
	{
		$date['mois'] = "Oct";
	}
	else if($date[1] == "11")
	{
		$date['mois'] = "Nov";
	}
	else if($date[1] == "12")
	{
		$date['mois'] = "Dec";
	}
	
	$date = $date['jour']." ".$date['mois']." ".$date['annee'];
		
	return $date;
}

// Appel de la fonction pour mettre l'heure au format RSS
function heure_rss($heure)
{
	$heure = explode("h", $heure);
	$heure['heure'] = $heure[0];
	$heure['minute'] = $heure[1];
	
	$heure = $heure['heure'].":".$heure['minute'];
		
	return $heure;
}
?>