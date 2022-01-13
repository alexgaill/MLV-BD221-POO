<?php
namespace App\Controller;

use App\Entity\Article;
use App\Model\ArticleModel;
use App\Model\CategorieModel;
use Core\Controller\DefaultController;

/**
 * Une class final est une class qui ne peut pas servir de class parent.
 * 
 * Cette class ne peut donc pas être extends, et ne peut pas avoir de méthodes abstract.
 * abstract etr final sont des opposés. L'erreur suivante apparaitra:
 * Cannot use the final modifier on an abstract class
 */
final class ArticleController extends DefaultController{

    public function __construct()
    {
        $this->model = new ArticleModel;
    }

    /**
     * Page d'accueil du site qui contient les 5 derniers articles
     * @return void
     */
    public function index()
    {
        $this->render("article/index", [
            "articles" => $this->model->getLast5()
        ]);
    }

    /**
     * Page d'article affichant les données en fonction de l'id de l'article sélectionné
     * @return void
     */
    public function single()
    {
        $id = (isset($_GET["id"]) && !empty($_GET["id"] && is_numeric($_GET["id"]))) ? $_GET["id"] : null;
        if ($id) {
            $this->render("article/single", [
                "article" => $this->model->find($id)
            ]);
        } else {
            $this->render("error/error", [
                "message" => "Nous ne trouvons pas l'article recherché"
            ]);
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
            $_POST = $this->secureData($_POST);
            $article = new Article($_POST);
            $articleId = $this->model->save($article());
            if ($articleId > 0) {
                header("Location: ?page=singleArt&id=$articleId");
            } else {
                $this->render("error/error", [
                    "message" => "Une erreur s'est produite durant l'enregistrement de l'article."
                ]);
            }
        }
        $this->render("article/save", [
            "cats" => (new CategorieModel)->findAll()
        ]);
    }

    /**
     * Modifie les données d'un article sélectionné en fonction de son id
     * @return void
     */
    public function update()
    {
        $id = (isset($_GET["id"]) && !empty($_GET["id"] && is_numeric($_GET["id"]))) ? $_GET["id"] : null;
        if ($id) {
            $this->render("article/update", [
                "cats" => (new CategorieModel)->findAll(),
                "article" => $this->model->find($id)
            ]);
        } else {
            $this->render("error/error", [
                "message" => "Nous ne trouvons pas l'article recherché"
            ]);

        }

        if (
            isset($_POST["title"]) && !empty($_POST["title"]) &&
            isset($_POST["content"]) && !empty($_POST["content"]) &&
            isset($_POST["categorie_id"]) && !empty($_POST["categorie_id"])
        ){
            $article = new Article($_POST);
            $articleBool = $this->model->update($article(), $id);
            if ($articleBool == true) {
                header("Location: ?page=singleArt&id=$id");
            } else {
                $this->render("error/error", [
                    "message" => "Une erreur s'est produite durant la mise à jour de l'article."
                ]);
            }
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
            $delete = $this->model->delete($id);
            if ($delete == true) {
                header("Location: index.php");
            } else {
                $this->render("error/error", [
                    "message" => "Une erreur s'est produite durant la mise à jour de l'article."
                ]);
            }
        } else {
            $this->render("error/error", [
                "message" => "Nous ne trouvons pas l'article recherché"
            ]);
        }
    }
}