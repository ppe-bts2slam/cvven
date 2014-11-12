<?php
/**
 * Description of Hebergement
 *
 * @author jeremy
 */

class Hebergement
{   
    private $id;
    private $type;
    private $emplacement;
    private $etage;
    private $remarques;
    
    function __construct($id, $type, $emplacements, $etage, $remarques)
    {
        $this->id = $id;
        $this->type = $type;
        $this->emplacement = $emplacement;
        $this->etage = $etage;
        $this->remarques = $remarques;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getEmplacement()
    {
        return $this->emplacement;
    }

    public function getEtage()
    {
        return $this->etage;
    }

    public function getRemarques()
    {
        return $this->remarques;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setEmplacement($emplacement)
    {
        $this->emplacement = $emplacement;
    }

    public function setEtage($etage)
    {
        $this->etage = $etage;
    }

    public function setRemarques($remarques)
    {
        $this->remarques = $remarques;
    }
    
    public function afficher()
    {
        echo "<table border='1'>";
        while()
        {
            echo "<tr>";
                echo "<td>".$this->type."</td>";
                echo "<td>".$this->emplacement."</td>";
                echo "<td>".$this->etage."</td>";
                echo "<td>".$this->remarques."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}