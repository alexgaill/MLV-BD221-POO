<?php
namespace App\Model;

class CategorieModel {

    /**
     * Retourne toutes les catégories de la BDD
     *
     * @return array
     */
    public function findAll(): array
    {
        $statementCat = "SELECT * FROM categorie";
        $query = $this->pdo->query($statementCat, \PDO::FETCH_CLASS, "App\Entity\Categorie");
        return $query->fetchAll();
    }
}