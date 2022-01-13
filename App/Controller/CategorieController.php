<?php

namespace App\Controller;

use App\Model\ArticleModel;
use App\Model\CategorieModel;
use Core\Controller\DefaultController;

final class CategorieController extends DefaultController
{

    public function __construct()
    {
        $this->model = new CategorieModel;
    }

    /**
     * Page présentant la liste des catégories de notre blog
     * @return void
     */
    public function index()
    {
        $this->render("categorie/index", [
            "categories" => $this->model->findAll()
        ]);
    }

    /**
     * Page de catégorie affichant les articles liés à cette catégorie
     * @return void
     */
    public function single()
    {
        $id = (isset($_GET["id"]) && !empty($_GET["id"] && is_numeric($_GET["id"]))) ? $_GET["id"] : null;
        if ($id) {
            $this->render("categorie/single", [
                "categorie" => $this->model->find($id),
                "articles" => (new ArticleModel)->findByCat($id)
            ]);
        } else {
            $this->render("error/error", [
                "message" => "Nous ne trouvons pas l'article recherché"
            ]);
        }
    }

    /**
     * Enregistre une catégorie dans la BDD
     * @return void
     */
    public function save()
    {
        if (
            isset($_POST["name"]) && !empty($_POST["name"])
        ) {
            $catId = $this->model->save($_POST);
            if ($catId > 0) {
                header("Location: ?page=singleCat&id=$catId");
            } else {
                $this->render("error/error", [
                    "message" => "Une erreur s'est produite durant l'enregistrement de l'article."
                ]);
            }
        }
        $this->render("categorie/save");
    }

    /**
     * Modifie les données d'une catégorie sélectionné en fonction de son id
     * @return void
     */
    public function update()
    {
        $id = (isset($_GET["id"]) && !empty($_GET["id"] && is_numeric($_GET["id"]))) ? $_GET["id"] : null;
        if ($id) {

            if (
                isset($_POST["name"]) && !empty($_POST["name"])
            ) {
                $categorieBool = $this->model->update($_POST, $id);
                if ($categorieBool == true) {
                    header("Location: ?page=singleCat&id=$id");
                } else {
                    $this->render("error/error", [
                        "message" => "Une erreur s'est produite durant la mise à jour de l'article."
                    ]);
                }
            }

            $this->render("categorie/update", [
                "categorie" => $this->model->find($id)
            ]);
        } else {
            $this->render("error/error", [
                "message" => "Nous ne trouvons pas l'article recherché"
            ]);
        }
    }

    /**
     * Supprime une catégorie en fonction de son id
     * @return void
     */
    public function delete()
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
