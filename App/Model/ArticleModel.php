<?php
namespace App\Model;

use App\Entity\Article;
use Core\Database\Database;

class ArticleModel extends Database{


    /**
     * Retourne les 5 derniers articles de la BDD
     *
     * @return array<int,Article>
     */
    public function getLast5 (): array
    {
        $statement = "SELECT * FROM article ORDER BY id DESC LIMIT 5";
        $query = $this->pdo->query($statement, \PDO::FETCH_CLASS, "App\Entity\Article");
        return $query->fetchAll();
    }

    /**
     * Retourne un article en fonction de l'id passé
     *
     * @param integer $id
     * @return Article
     */
    public function find(int $id): Article
    {
        $statement = "SELECT * FROM article WHERE id = $id";
        $query = $this->pdo->query($statement, \PDO::FETCH_CLASS, "App\Entity\Article");
        return $query->fetch();
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return int
     */
    public function save (array $data): int
    {
        $statement = "INSERT INTO article (title, content, categorie_id, user_id)
                               VALUES (:title, :content, :categorie_id, 1)";

        $prepare = $this->pdo->prepare($statement);
        $prepare->execute($data);
        $this->pdo->commit();
        return $this->pdo->lastInsertId();
        // $lastId = $this->pdo->lastInsertId();
        // if ($lastId > 0) {
        //     // $query = $this->pdo->query("SELECT * FROM article WHERE id = $lastId");
        //     // return $query->fetch(\PDO::FETCH_CLASS, "App\Entity\Article");
        // } else {
        //     return "Une erreur s'est produite durant l'enregistrement";
        // }

    }

    /**
     * Met à jour les données d'un article en BDD
     *
     * @param array $data
     * @param integer $id
     * @return integer
     */
    public function update (array $data, int $id): int
    {
        $statement = "UPDATE article SET 
                             title = :title,
                             content = :content,
                             categorie_id = :categorie_id
                             WHERE id = $id";
        $prepare = $this->pdo->prepare($statement);
        $prepare->execute($data);
        $this->pdo->commit();
        return $this->pdo->lastInsertId();
    }

    /**
     * Supprime un article dans la BDD
     *
     * @param int $id
     * @return boolean
     */
    public function delete(int $id): bool
    {
        $statement = "DELETE FROM article WHERE id = $id";
        $prepare = $this->pdo->prepare($statement);
        return $prepare->execute();
    }
}