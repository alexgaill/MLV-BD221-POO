<?php
namespace App\Trait;

/**
 * Methodes de sécurisation des données reçues
 * 
 * Les traits contiennent des méthodes que l'on va utiliser 
 * dans différentes parties de notre projet qui n'ont rien à voir
 * L'avantage d'utiliser des traits plutôt que des services réside dans la visibilité
 * L'utilisation d'un trait transfère les méthodes à la class comme elles sont définies.
 * 
 * Une méthode private sera considérée comme définie dans la class de façon private.
 * @method array secureData(array $data)
 */
trait SecurityTrait
{
    /**
     * Encode les données avec htmlspecialchars
     *
     * @param array $data
     * @return array
     */
    protected function secureData(array $data): array
    {
        foreach ($data as $key => $value) {
            $data[$key] = htmlspecialchars($value); // ">" => &gt; <script> => $lt;script$gt;
        }
        return $data;
    }
}
