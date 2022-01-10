<?php
namespace Classe;

/**
 * Une classe contient des propriétés et des méthodes
 * Les propriétés sont des variables contenant des informations
 * Les méthodes sont des fonctions
 * 
 * La visibilité:
 * 
 * Les prop. et les méthodes vont avoir une visibilité.
 * La visibilité définit la portée des différents éléments.
 * On appelle ça l'encapsulation
 * 
 * 3 visibilités:
 * 
 * public: Signifie que l'élément est accesible partout dans le code
 * private: Signifie que l'élément est accessible uniquement dans la class 
 *          ou il a été définit
 * protected: Signifie que l'élément est accessible dans la class ou il a été définit
 *          et dans les classes enfant. Mais l'élément n'est pas accessible dans l'index par exemple
 */
class MaClass {

    /**
     * @var string
     */
    public string $hello = "Hello World";

    /**
     * @var string|int
     */
    public string|int $prop;

    /**
     * @var array<int,string|int>
     */
    private $arrayProp;

    /**
     * @return string 
     */
    function base ():string
    {
        return "Base";
    }

    /**
     * @param string $param
     * @return string
     */
    function param (string $param):string
    {
        return ucfirst($param);
    }

    /**
     * @param string $param
     * @return string
     */
    function paramDefault (string $param = ""):string
    {
        if (!empty($param)) {
            return ucfirst($param);
        }
        return "La chaine de caractère est vide.";
    }

    /**
     * Cette méthode est un getter ou accesseur.
     * Elle permet de récupérer la valeur d'une propriété privée
     * pour l'utiliser.
     * @return array<int,string|int>
     */
    public function getArrayProp(): array
    {
        // $this-> fait référence à l'objet MaClass instancié
        // et permet d'utiliser les prop. et les méthodes
        return $this->arrayProp;
    }

    /**
     * Cette méthode est un setter ou mutateur.
     * Elle permet de définir la valeur d'une propriété privée.
     * @param array<int,string|int>
     * @return void ne retourne rien ou retourne du vide
     */
    public function setArrayProp(array $array)
    {
        $this->arrayProp = $array;
    }
}