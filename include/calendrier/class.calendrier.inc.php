﻿<?php
require_once 'class.mois.inc.php';
/**
 * Description de la classe calendrier
 *
 * @author Clément Boin
 */
class calendrier
{
    private $annee;
    
    public function __construct($annee)
	{
        $this->annee=$annee;
    }
    
    /**
     * Fonction permettant d'afficher au format d'un tableau HTML le calendrier
     * de l'année.
     * 
     * 
     * @param int $nbcolonne Nombre de colonne (4 par défaut)
     * @param type $id Pas fait pour l'instant
     */
    public function afficher_calendrier_annee($id="toto", $nbcolonne=4)
    {
		echo '<table class="cal-annee"><tr>';
		
		 for($num_mois=1;$num_mois<=12;$num_mois++)
		 {
			 echo '<td class="cal-annee">';
			 $mois= new mois($num_mois, $this->annee, $id);
			 $mois->afficher_calendrier_mois();
			 echo '</td>';
			 
			 if($num_mois%$nbcolonne==0 && $num_mois!=12)
			 {
				 echo '</tr><tr>';
			 }
		 }
		 echo '</tr></table>';
    }
}
