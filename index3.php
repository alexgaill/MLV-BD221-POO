<?php

/**
 * On peut créer des classes anonymes qui vont nous servir à certain moment dans notre code
 * sans avoir un créer un fichier dédié.
 * 
 * Généralement, on s'en sert pour charger une class avec un générateur qui sera utilisé dans un seul contexte
 * 
 */
$classe = new class {
    public $prop1 = 24;

    public $prop2 = "Coucou";

    public $prop3 = "test";

    private $prop4 = "private";

    public function createText()
    {
        return $this->prop2 ." ". $this->prop3;
    }
};
var_dump($classe);

/**
 * Les class peuvent être parcourues avec un foreach pour récupérer et traiter toutes les données.
 * Attention: Seule les propriétés public peuvent être parcourues.
 */
foreach ($classe as $key => $value) {
    echo "$key = $value";
    echo "<br>";
}