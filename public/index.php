<?php
session_start();
define("ROOT", dirname(__DIR__));

require ROOT . "/vendor/autoload.php";

require ROOT . "/router/router.php";

// use App\Manager\ArticleManager;

// $manager = new ArticleManager();
// $manager->index();
