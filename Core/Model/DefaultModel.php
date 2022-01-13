<?php
namespace Core\Model;

use Core\Database\Database;

class DefaultModel extends Database{

    /**
     * @var string
     */
    protected string $table;

    /**
     * Retourne tous les éléments d'une table de la BDD
     *
     * @return array|bool
     */
    public function findAll(): array|bool
    {
        $statementCat = "SELECT * FROM $this->table";
        $query = $this->pdo->query($statementCat, \PDO::FETCH_CLASS, "App\Entity\\". ucfirst($this->table));
        return $query->fetchAll();
    }

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

    public function findBy(array $criteria): array|bool
    {
        $statement = "SELECT * FROM $this->table WHERE ";
        foreach ($criteria as $key => $value) {
            $statement .= "$key = :$key AND ";
        }
        $statement = substr($statement, 0, -4);
        $prepare = $this->pdo->prepare($statement);
        $prepare->execute($criteria);
        return $prepare->fetchAll(\PDO::FETCH_CLASS, "App\Entity\\". ucfirst($this->table));
    }

    public function findOneBy(array $criteria): object|bool
    {
        $statement = "SELECT * FROM $this->table WHERE ";
        foreach ($criteria as $key => $value) {
            $statement .= "$key = :$key AND ";
        }
        $statement = substr($statement, 0, -4);
        $prepare = $this->pdo->prepare($statement);
        $prepare->execute($criteria);
        return $prepare->fetchObject("App\Entity\\". ucfirst($this->table));
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