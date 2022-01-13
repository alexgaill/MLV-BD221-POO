<?php
namespace Core\Interface;

interface UserControllerInterface 
// extends UserInterface
{

    /**
     * Inscrit l'utilisateur
     *
     * @return void
     */
    public function signup();

    /**
     * Vérifie les données de l'utilisateur et le connecte
     *
     * @return void
     */
    public function login();

    /**
     * Déconnecte l'utilisateur
     *
     * @return void
     */
    public function logout();

}