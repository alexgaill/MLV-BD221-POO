<?php
namespace App\Controller;

use Core\Controller\DefaultController;
use Core\Interface\UserControllerInterface;

final class UserController extends DefaultController implements UserControllerInterface{

    public function signup(){}

    public function login(){
        // Je vérifie les données de l'utilisateur et tout est ok

        $_SESSION["user"] = [
            "id" => 1,
            "nom" => "Doe",
            "prenom" => "John",
            "email" => "john@doe.com",
            "roles" => ["ROLE_USER"]
        ];
    }

    public function logout(){
        session_destroy();
    }
}