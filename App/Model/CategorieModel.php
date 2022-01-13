<?php
namespace App\Model;

use App\Entity\Categorie;
use Core\Model\DefaultModel;

/**
 * @method array|bool findAll()
 * @method Categorie|bool find(int $id)
 * @method bool delete(int $id) 
 * @method array|bool findBy(array $criteria)
 * @method object|bool findOneBy(array $criteria)
 */
final class CategorieModel extends DefaultModel{

    /**
     * @var string
     */
    protected string $table = "categorie";

    /**
     * Ajoute une catégorie en BDD
     *
     * @param array $data
     * @return integer
     */
    public function save(array $data): int
    {
        $statement = "INSERT INTO categorie (name) VALUES (:name)";
        $prepare = $this->pdo->prepare($statement);
        $prepare->execute($data);
        return $this->pdo->lastInsertId();
    }

    /**
     * Modifie les données d'une catégorie en BDD
     *
     * @param array $data
     * @param integer $id
     * @return boolean
     */
    public function update(array $data, int $id): bool
    {
        $statement = "UPDATE categorie SET name = :name WHERE id = $id";
        $prepare = $this->pdo->prepare($statement);
        return $prepare->execute($data);
    }
}