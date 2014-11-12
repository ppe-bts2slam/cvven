<?php session_start(); ?>
<!DOCTYPE html>

<html>
    <head>
	<title>Profil</title>
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
    <h1>Profil</h1>
    <FORM METHOD="post" ACTION="profil.php">     
          <table border="0" align="center" width="70%">
              <div><h4>Modifier mot de passe :</h4></div>

           
                <tr>
                        <td><label>Ancien mot de passe : </label></td>
                        <td><input type="password" name="user_mdp" value="<?php if(isset($_POST['user_mdp'])){echo $_POST['user_mdp'];} ?>" /></td>
                </tr>
                <tr>
                        <td><label>Nouveau mot de passe : </label></td>
                        <td><input type="password" name="user_mdp1" value="<?php if(isset($_POST['user_mdp1'])){echo $_POST['user_mdp1'];} ?>" /></td>
                </tr>
                <tr>
                        <td><label>Confirmer le nouveau mot de passe : </label></td>
                        <td><input type="password" name="user_mdp2" value="<?php if(isset($_POST['user_mdp1'])){echo $_POST['user_mdp1'];} ?>" /></td></td>
                </tr>
                <tr>
                        <td></td>
                        <td><input type="submit" value="Changer de mot de passe" name="new_mdp" /></td>
                </tr>
                <tr>
                        <td colspan="2"><?php if(isset($erreur)){echo $erreur;} ?></td>
                </tr>
        </table>  

        <?php if(isset($erreur)){echo $erreur;} ?>
 <!--fin formulaire -->

        </form>

        <?php
        if(isset($_POST['new_mdp'])) { // condifition si l'utilisateur a clic sur le boutton changer mot de passe
            
            if($_POST['user_mdp'] != '' AND $_POST['user_mdp1'] != '' AND $_POST['user_mdp2'] != '') { // condition si l'utilisateur à remplie tous les champs
                
                if($_SESSION['user_mdp'] == sha1($_POST['user_mdp'])) { // si l'ancien mot de passe est correcte
                    
                    if($_POST['user_mdp1'] == $_POST['user_mdp2']) { // si le les nouveaux mot de passe sont identique
                        
                        $_SESSION['user_mdp'] = sha1($_POST['user_mdp1']);
                        
                        // requete sql preparer
                        require('PDO.php');
                        $c=new Connexion();
                        $c->modifierMDP($_SESSION['user_id'], $_SESSION['user_mdp']);
                        
                        
                        echo $erreur = "<br/><br/><br/><br/><div style='font-size: 30px; text-align: center; color: red;'>Mot de passe modifié !</div>";
                        
                    }
                    else 
                        {
                       echo $erreur = "<br/><br/><br/><br/><div style='font-size: 30px; text-align: center; color: red;'>Les nouveaux mot de passe ne sont pas identique !</div>";} //sinon erreur
                        }
                else 
                    {
                    echo $erreur = "<br/><br/><br/><br/><div style='font-size: 30px; text-align: center; color: red;'>Mauvais mot de passe !</div>"; } // sinon erreur
                    }
            else 
                { 
                echo $erreur = "<br/><br/><br/><br/><div style='font-size: 30px; text-align: center; color: red;'>Remplir tout les champs !</div>"; } //sinon erreur
                }
        
        
        
        ?>
        
</div>
<!-- Pied de page de la page -->
<div id="piedpage">
	<?php include('include/piedpage.php'); ?>
</div>
    </body>
</html>