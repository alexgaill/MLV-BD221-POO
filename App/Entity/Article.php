<?php
namespace App\Entity;

use Core\Entity\DefaultEntity;

class Article extends DefaultEntity {
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $content;

    /**
     * @var int
     */
    private int $categorie_id;

    /**
     * @var int
     */
    private int $user_id;

    /**
     * @var string|null
     */
    private string|null $picture;

    /**
     * Méthode magique utilisée lorsqu'on utilise l'objet comme une fonction
     */
    public function __invoke() {
        return [
            "title" => $this->title,
            "content" => $this->content,
            "categorie_id" => $this->categorie_id
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getCategorieId(): int
    {
        return $this->categorie_id;
    }

    /**
     * @param int $categorie_id
     */
    public function setCategorieId(int $categorie_id): void
    {
        $this->categorie_id = $categorie_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string|null
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string|null $picture
     */
    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;
    }


}