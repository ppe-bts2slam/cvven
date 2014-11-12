<?php
class Utilisateur
{
    private $id ;
    private $email ;
    private $mdp ;
    private $prenom ;
    private $nom ;
    private $tel ;
    private $rue ;
    private $cp ;
    private $ville ;
    private $admin;
    
    public function __construct($id, $email,$mdp, $prenom, $nom, $tel, $rue, $cp, $ville, $admin=0)
	{
        $this->id = $id;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->tel = $tel;
        $this->rue = $rue;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->admin = $admin;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getTel() {
        return $this->tel;
    }

    public function getRue() {
        return $this->rue;
    }

    public function getCp() {
        return $this->cp;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }

    public function setRue($rue) {
        $this->rue = $rue;
    }

    public function setCp($cp) {
        $this->cp = $cp;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }

    public function setAdmin($admin) {
        $this->admin = $admin;
    }

        
    public function inscription()
    {
            $user_email = $this->email;
            $user_prenom = $this->prenom;
            $user_nom = $this->nom;
            $user_tel = $this->tel;
            $user_rue = $this->rue;
            $user_cp = $this->cp;
            $user_ville = $this->ville;
            $user_nom = $this->nom;
            
            // Je vais crypter le mot de passe.
            $user_mdp = sha1($this->mdp);

            require('PDO.php');
            $c=new Connexion();
            $c->ajouter($user_mdp, $user_prenom, $user_nom, $user_email, $user_rue, $user_tel, $user_cp, $user_ville, $this->admin);
    }
	
    public function afficher_erreur_inscription()
    {
        echo '<div style="color: red;">Les deux mots de passe que vous avez rentrés ne correspondent pas...</div>';
    }
}
?>