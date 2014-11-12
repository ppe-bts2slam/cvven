<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
		<title>Inscription</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
    </head>
<body>
<?php
if(isset($_POST['inscription']))
{
    if($_POST['user_mdp'] != '' && $_POST['user_mdp2'] != '' && $_POST['user_prenom'] != '' && $_POST['user_nom'] != '' && $_POST['user_email'] != '' && $_POST['user_tel'] != '' && $_POST['user_rue'] != '' && $_POST['user_cp'] != '' && $_POST['user_ville'] != '')
    {
        if($_POST['user_mdp'] == $_POST['user_mdp2'])
        {
            // Je vais crypter le mot de passe.
            $user_mdp = sha1($_POST['user_mdp']);

            require('PDO.php');
            $c=new Connexion();
            $c->ajouter($user_mdp, $_POST['user_prenom'], $_POST['user_nom'], $_POST['user_email'], $_POST['user_tel'], $_POST['user_rue'], $_POST['user_cp'], $_POST['user_ville']);
            header('Location: connexion.php');
            exit();
            $erreur = "<br/><br/><br/><br/><div style='font-size: 30px; text-align: center;'>Inscription réussi !</div>";
        }
        else
        {
            $erreur = "<br/><br/><br/><br/><div style='font-size: 30px; text-align: center; color: red;'>La confirmation de mot de passe ne correspond pas avec le mot de passe !</div>";
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
	 <h1>Inscription</h1>
    <form method="post">
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
                        <td><label>Confirmation du mot de passe :</label></td>
                        <td><input type="password" name="user_mdp2" /></td>
                </tr>
                <tr>
                        <td><label>Prénom : </label></td>
                        <td><input type="text" name="user_prenom" value="<?php if(isset($_POST['user_prenom'])){echo $_POST['user_prenom'];} ?>" /></td>
                </tr>
                <tr>
                        <td><label>Nom : </label></td>
                        <td><input type="text" name="user_nom" value="<?php if(isset($_POST['user_nom'])){echo $_POST['user_nom'];} ?>" /></td>
                </tr>
                <tr>
                        <td><label>Téléphone : </label></td>
                        <td><input type="text" name="user_tel" value="<?php if(isset($_POST['user_tel'])){echo $_POST['user_tel'];} ?>" /></td>
                </tr>
                <tr>
                        <td><label>Rue : </label></td>
                        <td><input type="text" name="user_rue" value="<?php if(isset($_POST['user_rue'])){echo $_POST['user_rue'];} ?>" /></td>
                </tr>
                <tr>
                        <td><label>Code Postal : </label></td>
                        <td><input type="text" name="user_cp" value="<?php if(isset($_POST['user_cp'])){echo $_POST['user_cp'];} ?>" maxlength="5" /></td>
                </tr>
                <tr>
                        <td><label>Ville : </label></td>
                        <td><input type="text" name="user_ville" value="<?php if(isset($_POST['user_ville'])){echo $_POST['user_ville'];} ?>" /></td>
                </tr>
                <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                </tr>
                <tr>
                        <td></td>
                        <td><input type="submit" value="inscription" name="inscription" /></td>
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