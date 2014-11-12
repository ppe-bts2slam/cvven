﻿<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
		<title>Connexion</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
    </head>
<body>
<?php
// Si le bouton connexion a été appuyé
if(isset($_POST['connexion']))
{
    // Si les 2 champs sont rempli
    if($_POST['user_email'] != '' && $_POST['user_mdp'] != '')
    {
        require('PDO.php');
        $c = new Connexion();
        $rep = $c->verif_user($_POST['user_email'], sha1($_POST['user_mdp']));
        
        if($rep != NULL)
        {
            $_SESSION['user_id'] = $rep['user_id'];
            $_SESSION['user_nom'] = $rep['user_nom'];
            $_SESSION['user_prenom'] = $rep['user_prenom'];
            $_SESSION['user_email'] = $rep['user_email'];
            $_SESSION['user_tel'] = $rep['user_tel'];
            $_SESSION['user_rue'] = $rep['user_rue'];
            $_SESSION['user_cp'] = $rep['user_cp'];
            $_SESSION['user_ville'] = $rep['user_ville'];
            $_SESSION['user_mdp'] = $rep['user_mdp'];
            $_SESSION['user_admin'] = $rep['user_admin'];

            header('Location: index.php');
            exit();
        }
        else
        {
            $erreur = "<br/><br/><br/><br/><div style='font-size: 30px; text-align: center; color: red;'>L'email ou le mot de passe est incorrect !</div>";
        }
    }
    else
    {
        $erreur = "<br/><br/><br/><br/><div style='font-size: 30px; text-align: center; color: red;'>Tous les champs sont obligatoires !</div>";
    }
}
?>
<!-- Entête de la page -->
<div id="entete">
        <?php include('include/entete.php'); ?>
    
	<?php include('include/menu.php'); ?>
</div>
<div id="contenu">
    <h1>Connexion</h1>
    <form method="post" action="connexion.php">
        <table border="0" align="center" width="70%">
                <tr>
                        <td><label>Adresse e-mail : </label></td>
                        <td><input type="text" name="user_email" value="<?php if(isset($_POST['user_email'])){echo $_POST['user_email'];} ?>" /></td>
                </tr>
                <tr>
                        <td><label>Mot de passe : </label></td>
                        <td><input type="password" name="user_mdp" value="<?php if(isset($_POST['user_mdp'])){echo $_POST['user_mdp'];} ?>" /></td>
                </tr>
                <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                </tr>
                <tr>
                        <td></td>
                        <td><input type="submit" value="connexion" name="connexion" /></td>
                </tr>
                <tr>
                        <td colspan="2"><?php if(isset($erreur)){echo $erreur;} ?></td>
                </tr>
        </table>
    </form>
</div>
<!-- Pied de page de la page -->
<div id="piedpage">
	<?php include('include/piedpage.php'); ?>
</div>
</body>
</html>
