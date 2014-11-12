<?php session_start(); ?>
<!DOCTYPE html>
<?php
include('PDO.php');
?>
<html>
    <head>
	<title>Reservation</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
<!-- Entête de la page -->
<div id="entete">
    <?php include('include/entete.php'); ?>
    
	<?php include('include/menu.php'); ?>
</div>
<div id="contenu">
    <h1>Réservation</h1>
	<?php include('include/calendrier.php'); ?>
    <form action="reservation.php" method="post">
        <table border="0" align="center" width="50%">
            <tr>
                <td>Nombre de personnes :</td>
                <td>
                    <select name="nb_personnes">
                    <?php
                    for ($i=1;$i<10;$i++) {
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Type de logement :</td>
                <td>
                    <select name="hebergement_type">
						<option value=""></option>
						<option value="deuxlits">Chambre de 2 lits</option>
						<option value="doublelits">Chambre double</option>
						<option value="troislits">Chambre de 3 lits</option>
						<option value="quatrelits">Chambre de 4 lits</option>
						<option value="chambrehandicape">Chambre pour handicapé</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Date :</td>
                <td><input type="text" name="reservation_date"></td>
            </tr>
            <tr>
                <td>Type de pension :</td>
                <td>
					<input type="radio" name="pension" value="0" />Pension complète
                    <br/>
					<input type="radio" name="pension" value="1" />Demi-pension
				</td>
            </tr>
            <tr>
                <td>Menage en fin de semmaine :</td>
                <td><input type="checkbox" name="reservation_menage" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="valider" value="Reserver" /></td>
        </table>
    </form>
</div>
<!-- Pied de page de la page -->
<div id="piedpage">
	<?php include('include/piedpage.php'); ?>
</div>
    </body>
</html>