<?php
namespace Classe;

class Magique{

    private array $data;

    private int $privateProp = 1;

    public int $publicProp;
    /**
     * S'active à l'instanciation d'une class / A la création d'un objet
     */
    public function __construct()
    {
        echo "La class est instanciée.";
        echo "<br>";
    }

    /**
     * S'active lorsqu'on arrête d'utiliser un objet
     */
    public function __destruct()
    {
        echo "L'objet n'est plus utilisé.";
        echo "<br>";
    }

    /**
     * S'active lors de la tentative d'appel d'une méthode inexistante, private ou protected
     *
     * Cette méthode est une méthode de surcharge de méthodes
     * 
     * @param string $name
     * @param array $arguments
     * @return void
     */
    public function __call(string $name, array $arguments)
    {
        echo "La méthode $name est inaccessible mais je te mets le var_dump des paramètres:";
        echo "<br>";
        var_dump($arguments);
        echo "<br>";
    }
    
    private function test1(string $string){
        return $string;
    }

    /**
     * Identique à __call mais pour les méthodes static
     * Attention: Cette méthode doit être static
     * 
     * Cette méthode est une méthode de surcharge de méthodes
     * 
     *
     * @param string $name
     * @param array $arguments
     * @return void
     */
    public static function __callStatic(string $name, array $arguments)
    {
        echo "La méthode $name est inaccessible mais je te mets le var_dump des paramètres:";
        echo "<br>";
        var_dump($arguments);
        echo "<br>";
    }

    private static function testStatic1(){}

    /**
     * S'active lorsqu'on essaye de donner une valeur à une prop. inexistante, private ou protected
     * Généralement on stocke ces infos dans un tableau appelé tableau de surcharge
     * 
     * Cette méthode est une méthode de surcharge de propriétés
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, mixed $value)
    {
        echo "Impossible d'accéder à $name. Cette propriété est inexistante, private ou protected.";
        echo "<br>";
        echo "Je stocke cette donnée dans un tableau de surcharge";
        echo "<br>";
        $this->data[$name] = $value;
    }

    /**
     * S'active lorsqu'on veut récupérer la valeur d'une prop. inexistante, private ou protected.
     * Dans ce cas, on essaye de récupérer la valeur dans le tableau de surcharge s'il possède la propriété.
     *
     * @param string $name
     * @return void
     */
    public function __get(string $name)
    {
        echo "$name n'existe pas, est protected ou private. Je regarde si j'ai ça dans mon tableau de surcharge";
        echo "<br>";
        if (isset($this->data[$name])) {
            echo "Voilà l'info...: ". $this->data[$name];
        } else {
            echo "$name n'est pas dans le tableau de surcharge";
        }
        echo "<br>";
    }

    /**
     * S'active lorsqu'on on utilise la fonction isset() sur une propriété inexistante, private ou protected
     * Dans ce cas, on vérifie si le tableau de surcharge possède la propriété.
     *
     * @param string $name
     * @return boolean
     */
    public function __isset(string $name)
    {
        echo "$name n'existe pas, est protected ou private. Je regarde si j'ai ça dans mon tableau de surcharge";
        echo "<br>";
        if (isset($this->data[$name])) {
            echo "La propriété est dans le tableau de surcharge";
        } else {
            echo "La propriété n'est pas dans le tableau de surcharge";
        }
        echo "<br>";
    }

    /**
     * S'active lorsqu'on utilise la fonction unset() sur une propriété inexistante, private ou protected
     * Dans ce cas, on supprime la propriété dans le tableau de surcharge si elle existe 
     *
     * @param string $name
     */
    public function __unset(string $name)
    {
        echo "$name n'existe pas, est protected ou private. Je regarde si j'ai ça dans mon tableau de surcharge";
        echo "<br>";
        if (isset($this->data[$name])) {
            unset($this->data[$name]);
            echo "La propriété a été unset dans le tableau de surcharge";
        } else {
            echo "La propriété n'existe pas dans le tableau de surcharge";
        }
        echo "<br>";
    }

    /**
     * S'active lorsqu'on utilise la fonction serialize().
     * Elle utilisée pour "nettoyer lo'bjet à serialiser => pour choisir les propriétés
     * que l'on va retourner dans le serialize.
     *
     * @return array
     */
    public function __sleep(): array
    {
        return ["data"];
    }

    /**
     * Fonctionne comme __sleep().
     * Cette méthode écrase l'utilisation de __sleep. 
     * 
     * On va favoriser serialize dans l'utilisation qui permet de récupérer toutes les propriétés
     * de la class et du parent y compris les propriétés private du parent
     * (sleep ne récupère que les propriétés public et protected du parent)
     * 
     * __sleep ne prend dans le tableau que les noms des propriétés qui seront serialisées
     * et à la deserialisation les propriétés si elles n'existent pas ou sont private 
     * vont entrer dans le __set.
     * 
     * avec __serialize, on peut passer un tableau avec des clés et la visibilité n'est pas prise en compte.
     *
     * @return array
     */
    public function __serialize(): array
    {
        return ["privateProp" => $this->privateProp, "data" => $this->data];
    }

    /**
     * S'active lorsqu'on utilise la fonction unserialize. Elle est utilisée pour exécuter du code
     * juste avant de déserialisre les données reçues.
     */
    public function __wakeup()
    {
        echo "Allez on deserialize";
        echo "<br>";
    }

    /**
     * Cette méthode écrase l'utilisation de __wakeup.
     * unserialize a un fonctionnement un peu différent de wakeup. 
     * Car il va d'abord unserialiser les données 
     * puis va les passer en paramètre de la méthode __unserialize.
     * On va donc pouvoir utiliser les données pour les traiter
     *
     * @param array $data
     * @return void
     */
    public function __unserialize(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * S'active lorsqu'on veut utiliser l'objet comme string.
     * Généralement, on peut renvoyer un message d'erreur, les données serialisées ou la valeur d'une prop.
     *
     * @return string
     */
    public function __toString(): string
    {
        return "Je ne suis pas une chaine de caractère mais un objet...";
    }

    /**
     * S'active lorsqu'on veut utiliser l'objet comme une fonction.
     */
    public function __invoke(... $arg)
    {
        $total = 0;
        foreach ($arg as $value) {
            $total += $value;
        }
        echo $total;
        echo "<br>";
    }

    /**
     * Appelée lors de l'utilisation de la fonction var_export()
     * Cette méthode doit être statique
     * Elle charge à nouveau la classe pour accéder aux propriétés et on lui passe
     * les paramètres de la classe initialement instanciée.
     *
     * @param array|object $properties
     * @return void
     */
    public static function __set_state( array|object $properties)
    {
        $magique = new Magique;
        $magique->publicProp = $properties["privateProp"];
    }

    /**
     * Appelée lors de l'utilisation de la fonction var_dump()
     * Permet de définir quelles informations seront visibles
     * 
     * Cette méthode doit obligatoirement retourner un tableau
     *
     * @return array
     */
    public function __debugInfo(): array
    {
        return ["message" => "Les données sont cachées :p"];
    }
}