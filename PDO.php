<?php
class Connexion extends PDO
{

    /**
     *  Constructeur qui hérite du constructeur de la classe PDO
     */
    public function __construct()
    {
        $this->sgbd = 'mysql';
        $this->hote = 'localhost';
        $this->bd = 'cvven';
        $this->user = 'root';
        $this->pass = 'root';
        $dns = $this->sgbd.':dbname='.$this->bd.";host=".$this->hote;
        
        //Appel du constructeur parent
        parent::__construct($dns, $this->user, $this->pass, array());
    }
    
    
    public function ajouter($user_mdp, $user_prenom, $user_nom, $user_email, $user_tel, $user_rue, $user_cp, $user_ville)
    {
		$req1 = $this->query('INSERT INTO user VALUES ("","'.$user_mdp.'","'.$user_prenom.'","'.$user_nom.'","'.$user_email.'","'.$user_tel.'","'.$user_rue.'","'.$user_cp.'","'.$user_ville.'","1")') or die("erreur de requête !");
    }
    
    public function modifierMDP($user_id, $user_mdp)
    {
		$req1 = $this->query('UPDATE user SET user_mdp = "'.$user_mdp.'" WHERE user_id = "'.$user_id.'"') or die("erreur de requête !");
    }
    
    public function verif_user($user_email, $user_mdp)
    {
		$req1 = $this->query("SELECT * FROM user WHERE user_email = '".$user_email."' AND user_mdp = '".$user_mdp."'") or die("erreur de requête !");
        $nb = $req1->rowCount();
        
        if($nb == 1)
        {
            $result = $req1->fetch();
            return $result;
        }
        else
        {
            return NULL;
        }
    }
	
	/**
     * Fonction qui renvoie le nombre de réservation pour une personne
     * 
     * @todo Renvoyer la liste des réservations
     * 
     * @param int $jour
     * @param int $mois
     * @param int $annee
     * @param type $id
     * @return int
     */
    public function est_reserve_util($jour, $mois, $annee, $id)
    {
        $ma_date=$annee.'-'.$mois.'-'.$jour;
    
        $requete="Select COUNT(*) FROM reservation, user
                    WHERE '$ma_date' BETWEEN reservation_date_arrivee AND SUBDATE(reservation_date_depart,1) 
                    AND reservation_user_id = user_id
                    AND user_id='$id'";
        
        $resultat_requete=$this->query($requete) or die("erreur est_reserve: $requete");
        $resultat=$resultat_requete->fetchColumn();
        return $resultat;   
    } 
    
    
    
    /**
     * Fonction qui prend en paramètre une date et qui renvoie le nombre de réservations ce jour.
     * 
     * 
     * @param int $jour
     * @param int $mois
     * @param int $annee
     * @return int
     */
    public function est_reserve($jour, $mois, $annee)
    {
      
        $ma_date=$annee.'-'.$mois.'-'.$jour;
        
        $requete="Select COUNT(*) FROM reservation
                    WHERE '$ma_date' BETWEEN reservation_date_arrivee AND SUBDATE(reservation_date_depart,1)" ;
        
        $resultat_requete=$this->query($requete) or die("erreur est_reserve");
        $resultat=$resultat_requete->fetchColumn();
        
        return $resultat; 
    } 
    
    
    public function est_complet($jour, $mois, $annee)
    {
      
        $ma_date=$annee.'-'.$mois.'-'.$jour;
        
        //Nombre d'attributions de réservations pour une date
        $requete="Select COUNT(*) "
                . "FROM reservation, attribuer_hebergement "
                . "WHERE '$ma_date' BETWEEN reservation_date_arrivee AND SUBDATE(reservation_date_depart,1) "
                . "AND reservation_id = ah_reservation_id;";
        
        $resultat_requete=$this->query($requete) or die("erreur est_complet: $requete");
        $resultat=$resultat_requete->fetchColumn();
        
        
        //Nombre d'hébergements disponibles
        $requete2="Select COUNT(*) From hebergement";
        
        
        $resultat_requete2=$this->query($requete2) or die("erreur est_complet 2");
        $resultat2=$resultat_requete2->fetchColumn();
        
        return $resultat==$resultat2; 
    }
}
?>