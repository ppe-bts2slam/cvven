<?php session_start(); ?>
<?php
if(isset($_SESSION['user_id']))
{
    unset($_SESSION);
    unset($_COOKIE);
    session_destroy();
    header ('Location: index.php');
    exit();
}
else
{
    header('Location: connexion.php');
}
?>