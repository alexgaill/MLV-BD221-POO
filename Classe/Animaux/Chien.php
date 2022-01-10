<?php
namespace Classe\Animaux;
class Chien extends Mammifere
{
    /**
     * Une constante est un élément dont la valeur ne change pas.
     * Une constante n'est accessible qu'à partir de la class et non de l'objet instancié
     */
    public const ANIMAL = "chien";
    private const foo = "bar";

    public function getCri(): string
    {
        $this->cri = "Ouaf";
        return $this->cri;
    }

    public function getAgeMammifere(): int|null
    {
        return $this->getAge();
    }

    /**
     * Une propriété ou méthode static est un élément rattaché à la classe.
     * On peut l'utiliser sans avoir à instancier la classe.
     *
     * @return string
     */
    public static function getFoo ():string
    {
        return self::foo;
    }

    public static function getType():string
    {
        // Pour récupérer une constante ou un élément static du parent,
        // on utilise le mot clé parent.
        // Une propriété static doit être appelée avec un $ devant
        // comme pour l'appel d'une variable
        return parent::$type;
    }

}