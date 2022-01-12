<?php

namespace App\Manager;

use App\Entity\Categorie;
use Core\Database\Database;

class CategorieManager
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
        $statement = "SELECT * FROM categorie";
        $query = $this->pdo->query($statement, \PDO::FETCH_CLASS, "App\Entity\Categorie");
        $categories = $query->fetchAll();

        include ROOT . "/templates/categorie/index.phtml";
    }

    /**
     * Page d'article affichant les données en fonction de l'id de l'article sélectionné
     * @return void
     */
    public function single()
    {
        $id = (isset($_GET["id"]) && !empty($_GET["id"] && is_numeric($_GET["id"]))) ? $_GET["id"] : null;
        if ($id) {
            $statement = "SELECT * FROM categorie WHERE id = $id";
            $query = $this->pdo->query($statement, \PDO::FETCH_CLASS, "App\Entity\Categorie");
            $categorie = $query->fetch();
            include ROOT . "/templates/categorie/single.phtml";
        } else {
            echo "Nous ne trouvons pas la categorie recherchée";
        }
    }

    /**
     * Enregistre un article dans la BDD
     * @return void
     */
    public function save()
    {
        // TODO: Ajout de l'utilisation de faker

        if (isset($_POST["name"]) && !empty($_POST["name"])){
            $categorie = new Categorie($_POST);
            // $categorie->hydrate($_POST);

            $statementArt = "INSERT INTO categorie (name) VALUES (:name)";
            $prepare = $this->pdo->prepare($statementArt);
            $prepare->execute($_POST);
        }

        // include ROOT . "/templates/categorie/save.phtml";
    }

    /**
     * Modifie les données d'un article sélectionné en fonction de son id
     * @return void
     */
    public function update()
    {
        $id = (isset($_GET["id"]) && !empty($_GET["id"] && is_numeric($_GET["id"]))) ? $_GET["id"] : null;
        if ($id) {
            $statement = "SELECT * FROM categorie WHERE id = $id";
            $query = $this->pdo->query($statement);
            $article = $query->fetchObject("App\Entity\Categorie");

            include ROOT . "/templates/article/update.phtml";
        } else {
            echo "Nous ne trouvons pas l'article recherché";
        }

        if (isset($_POST["name"]) && !empty($_POST["name"])){

            $statementArt = "UPDATE categorie SET 
                            name = :name
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
            $statement = "DELETE FROM categorie WHERE id = $id";
            $prepare = $this->pdo->prepare($statement);
            $prepare->execute();
            echo "La catégorie a bien été supprimée!";
        } else {
            echo "Nous ne trouvons pas la catégorie recherchée";
        }
    }
}