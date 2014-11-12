<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'class.jour.inc.php';

/**
 * Classe mois
 *
 * @author Clément Boin
 */
class mois
{
    private $num_mois;
    private $annee;
    /**
     *
     * @var jour array 
     */
    private $liste_jours;
    private $id;
    
    public function __construct($num_mois, $annee=2014, $id="toto") {
        $this->num_mois=$num_mois;
        $this->annee= $annee;
        $this->liste_jours = array();
        $this->id=$id;
        
        // Construction du tableau de jours
        $num_jour=1;
        //Jours du mois précédent
        for($i=$this->jour_debut_calendrier();$i<=$this->nb_jours_mois_prec();$i++)
        {
            $jour=new jour($i,"prec");
            array_push($this->liste_jours,$jour);
            $num_jour++;
            
        }
             
        //Mois courant
        for($i=1;$i<=mois::nb_jours($num_mois,$annee);$i++)
        {
            $jour=new jour($i, "normal");
            array_push($this->liste_jours,$jour);
            $num_jour++;
        }
        
        //Fin du mois
        $i=1;
        while($num_jour<=42)
        {
            $jour=new jour($i,"suiv");
            array_push($this->liste_jours,$jour);
            $num_jour++; 
            $i++;
        }
        
        //Inclure les réservation de la base de données
  
        $this->inclure_demandes();
        
    }
    
        
   /**
    * Fonction qui renvoie le nombre de jour du mois passé en argument ($num)
    * 
    * @return int
    */
   public static function nb_jours($num, $annee)
   {
        $nb_jours_mois=date('t',mktime(0,0,0,$num,1,$annee));
        return $nb_jours_mois;        
   }
   
   
   /**
    * Fonction qui calcule le nombre de jours du mois précédent 
    * 
    * @return int
    * 
    */
   public function nb_jours_mois_prec()
   {
        if($this->num_mois==1)
        {//Cas particulier du mois de décembre
            $nbj_mois_prec=31; 
        }
        else
        {//Les autres mois
            $nbj_mois_prec=mois::nb_jours($this->num_mois-1, $this->annee);
        }
        
        return $nbj_mois_prec;
   }
   
   
   /**
    *  Fonction qui calcule du jour de début du calendrier du mois
    * 
    * @return int
    */
   public function jour_debut_calendrier()
   {
        $jour_semaine=date('N',mktime(0,0,0,$this->num_mois,1,$this->annee)); 
        
        return $this->nb_jours_mois_prec()-$jour_semaine+2;
   }
   
   
   
   /**
    *  Fonction statique qui renvoie une chaîne contenant 
    *  le mois passé en paramètre ($num)
    * 
    * @param string $format
    * @param string $langue
    * @return string
    */
    public static function nom_du_mois($num, $format="long", $langue="fr")
    {
        if($langue=="fr")
        {
                $mois[1]="Janvier";
                $mois[2]="Février";
                $mois[3]="Mars";
                $mois[4]="Avril";
                $mois[5]="Mai";
                $mois[6]="Juin";
                $mois[7]="Juillet";
                $mois[8]="Août";
                $mois[9]="Septembre";
                $mois[10]="Octobre";
                $mois[11]="Novembre";
                $mois[12]="Décembre";
        }
        $resultat=$mois[$num];
        if($format=="court")
        {
                    $resultat=  substr($mois[$num], 0, 3);
        }

        return $resultat;
    }
    
    
    
    
    /** 
     * Fonction qui affiche le calendrier du mois au format HTML
     * 
     * @param type $id
     */
    public function afficher_calendrier_mois()
    {
        //Ligne de titre
        echo '<table class="calendrier">
                <tr> <th colspan="7">'
                .$this->nom_du_mois($this->num_mois).' '.$this->annee.
                '</th></tr>';
        
       //Ligne des jours de la semaine
       echo '<tr>';
       for($i=1;$i<=7;$i++)
       {
           echo '<td>'.jour::jour_semaine($i).'</td>';
       }
         echo '</tr> 
         <tr>';
       
       //Jours du tableau
       $nb_jour_sem=1;
       $nb_jour_mois=1;
       foreach($this->liste_jours as $jour)
       {
           echo $jour->balise_td_jour();
           
           if($nb_jour_sem==7 && $nb_jour_mois!=42)
           {
               echo '</tr><tr>';
               $nb_jour_sem=1;
           }
           else
           {
               $nb_jour_sem++;
           }       
           $nb_jour_mois++;              
       }
        echo '</tr>
            </table>';
    }
	
    /**
     * Fonction qui ajoute les réservations de l'utilisateur courant
     * depuis la base de données, et qui indique si un jour est complet.
     * 
     * Le type des jours par défaut ("normal") est modifié:
     * 
     * - Si journée complète: "complet"
     * - Si réservation pour l'utilisateur courant: "demande"
     * 
     */
    public function inclure_demandes()
    {
        $con=new Connexion();
        
        foreach($this->liste_jours as $jour)
        {        
            // Jours complets (tous les hébergements attribués)
            if($con->est_complet($jour->getNum(),$this->num_mois,$this->annee)
                    && ($jour->getType()=="normal"))
            {
                $jour->setType("complet"); //Reservation de l'utilisateur courant
            } 
            
            // Demandes de l'utilisateur courant
            if($con->est_reserve_util($jour->getNum(),$this->num_mois,$this->annee,$this->id)>=1 
                    && $jour->getType()=="normal")
            {
                $jour->setType("demande"); //Reservation de l'utilisateur courant
            }    
        }
    }
}
