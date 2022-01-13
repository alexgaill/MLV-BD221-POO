<?php
namespace Core\Model;

use Core\Database\Database;

class DefaultModel extends Database{

    /**
     * @var string
     */
    protected string $table;

    /**
     * Retourne les données d'un objet récupéré en BDD en fonction de l'id passé
     *
     * @param int $id
     * @return object|boolean
     */
    public function find(int $id): object|bool
    {
        $statement = "SELECT * FROM $this->table WHERE id = $id";
        $query = $this->pdo->query($statement, \PDO::FETCH_CLASS, "App\Entity\\". ucfirst($this->table));
        return $query->fetch();
    }

    /**
     * Supprime les données d'un objet en BDD en fonction de l'id passé
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool
    {
        $statement = "DELETE FROM $this->table WHERE id = $id";
        $prepare = $this->pdo->prepare($statement);
        return $prepare->execute();
    }
}