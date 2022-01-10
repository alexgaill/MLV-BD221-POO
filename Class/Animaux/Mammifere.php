<?php
namespace Class\Animaux;

class Mammifere
{
    /**
     * @var string
     */
    private string $nom;

    /**
     * @var string
     */
    private string $couleur;

    /**
     * @var string
     */
    private string $race;

    /**
     * @var int|null
     */
    private int|null $age;

    /**
     * @var string
     */
    protected string $cri;

    /**
     * @var string
     */
    protected static $type = "Mammifère";

    /**
     * Un constructeur permet à l'instanciation d'un objet de passer des paramètres permettant
     * de donner des valeurs à certaines ou toutes les propriétés.
     *
     * @param string $nom
     * @param string $couleur
     * @param string $race
     * @param int|null $age
     */
    public function __construct(string $nom, string $couleur, string $race, int $age = null)
    {
        var_dump(__CLASS__);
        $this->nom = $nom;
        $this->couleur = $couleur;
        $this->race = $race;
        $this->age = $age;
    }

    // Version php8 de déclaration d'un constructeur avec génération des prop.
    /* public function __construct(private string $nom, private string $couleur, private string $race, private int $age)
    {} */

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return void
     */
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getCouleur(): string
    {
        return $this->couleur;
    }

    /**
     * @param string $couleur
     */
    public function setCouleur(string $couleur): void
    {
        $this->couleur = $couleur;
    }

    /**
     * @return string
     */
    public function getRace(): string
    {
        return $this->race;
    }

    /**
     * @param string $race
     */
    public function setRace(string $race): void
    {
        $this->race = $race;
    }

    /**
     * @return int|null
     */
    public function getAge(): int|null
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }
}