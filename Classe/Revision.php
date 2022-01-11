<?php

namespace Classe;

/**
 * Une classe est un modèle ou une représentation d'objets que nous pouvons créer.
 * Une classe contient des propriétés (variables) et des méthodes (fonctions)
 */
class Revision
{
    /**
     * Les propriétés et les méthodes ont une visibilité ou une portée d'utilisation.
     * Il en existe 3:
     * Public: l'élément est accessible partout dans le code
     * Private: l'élément est accessible uniquement dans la classe dans laquelle il a été déclaré
     * Protected: l'élément est accessible dans la classe où il a été déclaré et dans les classes enfants
     */

    /**
     * @var int
     */
   public int $prop1;

    /**
     * @var array
     */
   private array $prop2;

    /**
     * @var string
     */
   private string $prop3 = "test";

    /**
     * @var string
     */
   protected string $protec;


   public static int $stat = 6;

    /**
     * __construct est une méthode magique appelée à l'instanciation d'une classe.
     * Elle exécute automatiquement le code présent à l'intérieur.
     * Généralement, on s'en sert pour attribuer des valeurs aux propriétés de la classe.
     */
   public function __construct ()
   {
       var_dump($this);
   }

    /**
     * @return string
     */
   public function method1 (): string
   {
       return "Hello";
   }

    /**
     * @param int $nb1
     * @param int $nb2
     * @return int
     */
   private function param1 (int $nb1, int $nb2): int
   {
       return $nb1 + $nb2;
   }

    /**
     * getProp2 est un getter ou accesseur qui permet d'accéder à la propriété prop2 qui est private
     * $this fait référence à la propriété présente dans la classe et qui sera une propriété des objets instanciés
     * @return array
     */
   public function getProp2(): array
   {
       return $this->prop2;
   }

    /**
     * setProp2 est un setter ou mutateur qui permet de modifier la valeur de la propriété prop2 qui est private
     * @param array $prop
     * @return void
     */
   public function setProp2(array $prop)
   {
       $this->prop2 = $prop;
   }
}

$rev = new Revision();
$rev->prop1;
$rev->getProp2();


/**
 * Revision 2 est un enfant de Revision.
 * On parle d'héritage
 * Revision2 accède ainsi aux propriétés et méthodes de révision et peut les utiliser excepté les éléments private
 */
class Revision2 extends Revision {

    /**
     * Une classe peut posséder des constantes
     */
    public const CONSTANTE = "constante";

    public static int $statProp = 12;

    /**
     * La propriété protec est protected. elle est donc accessible dans la classe où elle est déclarée
     * et dans les classes enfants.
     * On peut donc si on le souhaite créer un getter pour cette propriété dans un enfant.
     * @return string
     */
    public function getProtec (): string
    {
        return $this->protec;
    }

    public static function getAllStatic ()
    {
        /**
         * Pour récupérer un élément static du parent, on n'utilise pas "$this" mais "parent::"
         * pour faire référence au parent en temps que classe.
         * Pour appeler une propriété on doit impérativement utiliser le $
         *
         * Pour récupérer un élément static de la classe, on utilise "self::"
         * qui fait référence à la classe en question.
         */
        return parent::$stat + self::$statProp;
    }
}

/**
 * Les constantes, les éléments static et le nom de la classe sont récupérable sans avoir à instancier un objet.
 * On fait référence à la classe, on utilise l'opérateur de résolution de portée "::"
 * et on appelle l'élément dont on a besoin.
 * Ces éléments appartiennent à la classe et non aux objets instanciés.
 */
Revision2::class;
Revision2::CONSTANTE;
Revision2::$statProp;
Revision2::getAllStatic();