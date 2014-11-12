<?php
require("include/calendrier/class.calendrier.inc.php");

if (isset($_GET['annee']))
{
	$annee = $_GET['annee'];
}
else
{
	$annee = date('Y');
}


//Affichage du calendrier du mois en cours
$cal = new calendrier($annee);

//$cal->afficher_calendrier_mois_annee(date('n'),date('Y'));
$cal->afficher_calendrier_annee();

echo 	'<table class="cal-navig">
			<tr>
				<td class="anneeprec">
					<a href="index.php?annee=' . ($annee - 1) . '">
						<img src="images/prec.png" alt="' . ($annee - 1) . '" style="border:none;" />
					</a>
				</td>
				<td class="anneesuiv">
					<a href="index.php?annee=' . ($annee + 1) . '">
						<img src="images/suiv.png" alt="' . ($annee + 1) . '" style="border:none;" />
					</a>
				</td>
			</tr>
		</table>';
?>