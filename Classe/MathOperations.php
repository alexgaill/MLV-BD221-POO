<?php
namespace Classe;
/**
 * Une class est une représentation des objets que l'on va créer
 */
class MathOperations {
    
    /**
     * La fonction addition est une méthode de la class MathOperations
     * Elle retourne le résultat de l'addition de 2 nombres
     * 
     * @param int $num1 Premier nombre à additionner
     * @param int $num2 Deuxième nombre à additionner
     * @return int
     */
    function addition(int $num1, int $num2): int
    {
        return $num1 + $num2;
    }
}