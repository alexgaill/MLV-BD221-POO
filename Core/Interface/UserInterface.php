<?php
namespace Core\Interface;

interface UserInterface{

    /**
     * Retourne la password de l'utilisateur
     *
     * @return string
     */
    public function getPassword(): string;

    /**
     * Retourne les roles de l'utilisateur
     *
     * @return array
     */
    public function getRoles(): array;
}