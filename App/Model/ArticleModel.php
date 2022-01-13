<?php
namespace App\Model;

use App\Entity\Article;
use Core\Model\DefaultModel;

/**
 * @method array|bool findAll()
 * @method Article|bool find(int $id)
 * @method array|bool findBy(array $criteria)
 * @method object|bool findOneBy(array $criteria)
 * @method bool delete(int $id)
 */
final class ArticleModel extends DefaultModel{

    /**
     * @var string
     */
    protected string $table = "article";

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
     * Undocumented function
     *
     * @param array $data
     * @return int
     */
    public function save (array $data): int
    {
        var_dump(isset($_SESSION["user"]));
        $statement = "INSERT INTO article (title, content, categorie_id, user_id)
                               VALUES (:title, :content, :categorie_id, 1)";

        $prepare = $this->pdo->prepare($statement);
        $prepare->execute($data);
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
     * @return boolean
     */
    public function update (array $data, int $id): bool
    {
        $statement = "UPDATE article SET 
                             title = :title,
                             content = :content,
                             categorie_id = :categorie_id
                             WHERE id = $id";
        $prepare = $this->pdo->prepare($statement);
        return $prepare->execute($data);
    }

    /**
     * Retourne les articles possédant la catégorie sélectionnée
     *
     * @param integer $id
     * @return array
     */
    public function findByCat(int $id): array
    {
        $statement = "SELECT id, title FROM article WHERE categorie_id = $id";
        $query = $this->pdo->query($statement, \PDO::FETCH_CLASS, "App\Entity\Article");
        return $query->fetchAll();
    }
}