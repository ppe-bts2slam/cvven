<!--------- Menu --------->
<div id="menu">
	<table border="0" id="menu" width="100%">
<?php
if (!isset($_SESSION['user_id']))
{
?>
    <tr>
	<td width="25%"> <a href="index.php"class="type"><img src="images/accueil.gif" height="22" width="22" style="vertical-align: middle" /> Accueil</td>
        <td> | </td>
	<td width="25%"> <a href="reservation.php"class="type"><img src="images/reservation.gif" height="22" width="22" style="vertical-align: middle" /> Reservation</td>
        <td> | </td>
        <td width="25%"> <a href="connexion.php"class="type"><img src="images/connexion.ico" height="22" width="22" style="vertical-align: middle" /> Connexion</td>
        <td> | </td>
        <td width="25%"> <a href="inscription.php"class="type" ><img src="images/inscription.gif" height="22" width="22" style="vertical-align: middle" /> Inscription</td>
    </tr>
<?php
}
else	// si aucune session est active
{
?>
    <tr>
        <td width="33%"> <a href="index.php"class="type"><img src="images/accueil.gif" height="22" width="22" style="vertical-align: middle" /> Accueil</td>
        <td> | </td>
        <td width="25%"> <a href="profil.php"class="type" ><img src="images/profil.gif" height="22" width="22" style="vertical-align: middle" /> Profil</td>
        <td> | </td>
        <td width="33%"> <a href="reservation.php"class="type"><img src="images/reservation.gif" height="22" width="22" style="vertical-align: middle" /> Reservation</td>
        <td> | </td>
        <td width="33%"> <a href="deconnexion.php"class="type"><img src="images/deconnexion.ico" height="22" width="22" style="vertical-align: middle" /> Deconnexion</td>
    </tr>
<?php
}
?>			
	</table>
</div>
<!------------------------>
