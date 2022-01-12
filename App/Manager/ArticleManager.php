<?php

namespace App\Manager;

use App\Entity\Article;
use Core\Database\Database;

class ArticleManager
{
    /**
     * @var \PDO|null
     */
    private \PDO|null $pdo;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        try {
            $this->pdo = (new Database())->pdo;
            is_null($this->pdo) ? throw new \Exception("Erreur dans les identifiants de connexion à la BDD") : "";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Page d'accueil du site qui contient les 5 derniers articles
     * @return void
     */
    public function index()
    {
        $statement = "SELECT * FROM article ORDER BY id DESC LIMIT 5";
        $query = $this->pdo->query($statement, \PDO::FETCH_CLASS, "App\Entity\Article");
        $articles = $query->fetchAll();

        include ROOT . "/templates/article/index.phtml";
    }

    /**
     * Page d'article affichant les données en fonction de l'id de l'article sélectionné
     * @return void
     */
    public function single()
    {
        $id = (isset($_GET["id"]) && !empty($_GET["id"] && is_numeric($_GET["id"]))) ? $_GET["id"] : null;
        if ($id) {
            $statement = "SELECT * FROM article WHERE id = $id";
            $query = $this->pdo->query($statement, \PDO::FETCH_CLASS, "App\Entity\Article");
            // $article = $query->fetchObject();
            $article = $query->fetch();
            include ROOT . "/templates/article/single.phtml";
        } else {
            echo "Nous ne trouvons pas l'article recherché";
        }
    }

    /**
     * Enregistre un article dans la BDD
     * @return void
     */
    public function save()
    {
        if (
            isset($_POST["title"]) && !empty($_POST["title"]) &&
            isset($_POST["content"]) && !empty($_POST["content"]) &&
            isset($_POST["categorieId"]) && !empty($_POST["categorieId"])
        ){
            $article = new Article($_POST);

            $statementArt = "INSERT INTO article (title, content, categorie_id, user_id)
                               VALUES (:title, :content, :categorie_id, 1)";

            $prepare = $this->pdo->prepare($statementArt);
            // On utilise l'objet article comme une fonction en ajoutant des () après la variable
            $prepare->execute($article());
        }
        $statementCat = "SELECT * FROM categorie";
        $query = $this->pdo->query($statementCat, \PDO::FETCH_CLASS, "App\Entity\Categorie");
        $cats = $query->fetchAll();
        include ROOT . "/templates/article/save.phtml";
    }

    /**
     * Modifie les données d'un article sélectionné en fonction de son id
     * @return void
     */
    public function update()
    {
        $id = (isset($_GET["id"]) && !empty($_GET["id"] && is_numeric($_GET["id"]))) ? $_GET["id"] : null;
        if ($id) {
            $statement = "SELECT * FROM article WHERE id = $id";
            $query = $this->pdo->query($statement);
            $article = $query->fetchObject();

            $statementCat = "SELECT * FROM categorie";
            $query = $this->pdo->query($statementCat, \PDO::FETCH_CLASS, "App\Entity\Article");
            $cats = $query->fetchAll();
            include ROOT . "/templates/article/update.phtml";
        } else {
            echo "Nous ne trouvons pas l'article recherché";
        }

        if (
            isset($_POST["title"]) && !empty($_POST["title"]) &&
            isset($_POST["content"]) && !empty($_POST["content"]) &&
            isset($_POST["categorie_id"]) && !empty($_POST["categorie_id"])
        ){

            $statementArt = "UPDATE article SET 
                             title = :title,
                             content = :content,
                             categorie_id = :categorie_id
                             WHERE id = $id";

            $prepare = $this->pdo->prepare($statementArt);
            $prepare->execute($_POST);
        }
    }

    /**
     * Supprime un article en fonction de son id
     * @return void
     */
    public function delete ()
    {
        $id = (isset($_GET["id"]) && !empty($_GET["id"] && is_numeric($_GET["id"]))) ? $_GET["id"] : null;
        if ($id) {
            $statement = "DELETE FROM article WHERE id = $id";
            $prepare = $this->pdo->prepare($statement);
            $prepare->execute();
            echo "L'article a bien été supprimé!";
        } else {
            echo "Nous ne trouvons pas l'article recherché";
        }
    }
}