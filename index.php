<?php

define ("ROOT", __DIR__);

require "Class/Autoloader.php";
\Class\Autoloader::register();

use Class\MathOperations;
use Class\MaClass;
use Class\Animaux\Chien;

// On instancie la class MathOperations pour créer un objet lié
// à cette class et contenant la méthode addition
$math = new MathOperations();

// On utilise la méthode addition.
// Pour utiliser une propriété ou une méthode, on appelle l'objet
// et on utilise "->" pour appeler la prop. ou la méthode
echo $math->addition(3, 15);
echo "<br>";

$classe = new MaClass();
// J'appelle une propriété
echo $classe->hello;
echo "<br>";
// J'appelle une méthode
echo $classe->base();
echo "<br>";
echo $classe->param("coucou");
echo "<br>";
echo $classe->paramDefault();
echo "<br>";

$classe->prop = 4;
// $classe->prop = ["test", "test"];
var_dump($classe->prop);
echo "<br>";
// var_dump($classe->arrayProp); // retourne une erreur car on ne peut pas accéder à la prop. privée

$classe->setArrayProp(["test", 35]);
var_dump($classe->getArrayProp());
echo "<br>";

/**
 * Créer une classe Chien qui va contenir les propriétés privées suivantes:
 *
 * nom, couleur, race, age
 * ajouter la méthode cri qui retourne le cri du chien ("ouaf")
 *
 * avec les méthodes correspondantes
 *
 * Faire la même chose avec la classe Chat
 * ajouter la méthode cri qui retourne le cri du chien ("miaou")
 *
 * php getter & setter
 * php8 getter & setter
 */

$chien = new Chien("Rex", "marron", "Chihuahua", 4);
/* $chien->setNom("Rex");
$chien->setCouleur("marron");
$chien->setRace("Chihuahua");
$chien->setAge(4); */

$chien2 = new Chien(nom: "Honey", couleur: "blanc", race: "Lévrier", age: 5);

var_dump($chien);
echo "<br>";
var_dump($chien2);
echo "<br>";
// echo $chien->getAge();
echo $chien->getAgeMammifere();
echo "<br>";
echo $chien->getCri();
echo "<br>";
// Retourne une erreur car cri est protected et non accessible en dehors de la class parent
// ou enfant
// echo $chien->cri;

// Une constante est un élément appartenant à la classe et non à l'objet instancié.
// Pour l'utiliser, on doit faire appel à l'élément en utilisant le nom de la classe
// et l'opérateur de résolution de portéee "::"
// Cet opérateur est utilisé pour récupérer le nom de la class, les constantes
// et les éléments statiques
echo Chien::class;
echo "<br>";
echo Chien::ANIMAL;
echo "<br>";
echo $chien->getFoo();
echo "<br>";
echo Chien::getFoo();
