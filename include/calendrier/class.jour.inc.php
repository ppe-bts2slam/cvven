<?php

/**
 * Classe jour
 * 
 * Un jour est déterminé par un numéro et un type correspondant à son
 * statut (reservé, complet, normal...)
 * 
 * @author Clément Boin
 *
 */
class jour {
    private $num;
    private $type;
    
    function __construct($num, $type) {
        $this->num = $num;
        $this->type = $type;
    }
    
    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }
    public function getNum() {
        return $this->num;
    }

    public function setNum($num) {
        $this->num = $num;
    }    

    /**
     * Fonction statique qui renvoie une chaîne contenant 
     * le jour passé en paramètre ($num)
     * 
     * 
     * @param int $num Numéro du jour de la semaine
     * @param string $langue Juste le français pour le moment
     * @param string $format Format de retour (court  par défaut)
     */
    public static function jour_semaine($num, $format="court", $langue="fr")
    {
        if($langue=="fr")
        {
                $jours[1]="Lundi";
                $jours[2]="Mardi";
                $jours[3]="Mercredi";
                $jours[4]="Jeudi";
                $jours[5]="Vendredi";
                $jours[6]="Samedi";
                $jours[7]="Dimanche";
        }
        $resultat=$jours[$num];
        if($format=="court")
        {
                    $resultat=  substr($jours[$num], 0, 3);
        }

        return $resultat;
    }
    
    
    /**
     * Fonction qui renvoie la case d'un tableau avec le style de case
     * en fonction du type de cette case.
     * 
     * @return string
     */
    public function balise_td_jour()
    {
        switch($this->type)
        {
            //Journée normale du calendrier sans aucune réservation
            case "normal":      $res= '<td>'; 
                                 break;
            //Case grisée du calendrier (mois suivant et précédent)
            case "prec":      $res= '<td class="grisee">'; 
                                 break;
                             
            //Journée complète selon la base de données
            case "complet":     $res= '<td class="complet">'; 
                                 break;
                             
            //Réservation validée
            case "reservation": $res= '<td class="reservation">'; 
                                 break;
                             
            //Demande de réservation en cours
            case "demande":     $res= '<td class="demande">'; 
                                 break;
            default:            $res= '<td class="grisee">';
        }
        return $res.$this->num.'</td>';
    }
    
}


?>
