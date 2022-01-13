<?php
namespace App\Controller;

use Core\Controller\DefaultController;

final class ErrorController extends DefaultController{

    public function urlError()
    {
        $this->render("error/error", [
            "message" => "Page introuvable retour à l'accueil <a href='index.php'>ici</a>"
        ]);
    }
}