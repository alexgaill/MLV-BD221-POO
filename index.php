<?php

const ROOT = __DIR__;

require "vendor/autoload.php";

use App\Controller\ArticleController;
// use App\Manager\ArticleManager;

// $manager = new ArticleManager();
// $manager->index();

$controller = (new ArticleController)->index();

